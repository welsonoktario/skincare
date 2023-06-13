<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Topup;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Throwable;

class TopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topups = Auth::user()->topups()->get();
        return view('user.topup.index', compact('topups'));
    }
    public function create()
    {
        $saldo = Auth::user()->saldo;
        return view('user.topup.create', compact('saldo'));
    }
    public function store(Request $request)
    {
        $nominal = $request->nominal;
        $topup = Auth::user()
            ->topups()
            ->create(compact('nominal'));

        return redirect()->back();
    }

    public function edit($id)
    {
        $topup = Topup::find($id);
        return view('user.topup.edit', compact('topup'));
    }


    public function update(Request $request, $id)
    {
        $fileBuktiPembayaran = $request->file('bukti_pembayaran');

        try {
            $buktiPembayaran = Storage::disk('local')->putFileAs(
                'topups',
                $fileBuktiPembayaran,
                "topup-{$id}.{$fileBuktiPembayaran->extension()}"
            );
            $topup = Topup::query()->find($id);
            $topup->update([
                'bukti_pembayaran' => $buktiPembayaran,
                'status' => 'pending'
            ]);

            return redirect()->back();
        } catch (Throwable $e) {
            return redirect()->back()->withErrors([
                'msg' => 'Terjadi kesalahan memverifikasi pembayaran'
            ]);
        }
    }

    public function getTopUp(Request $request)
    {
        // count payment gateway in index
        $user = Auth::user();
        // PAYMENT
        $getName = $user->nama;
        $getPhone = $user->no_hp;
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-yUxga--v_4EQ_EKe8TWMMmbZ';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // $grand_total =  $total + $ongkirs; sementara belum ada ongkos kirim yang ter-generate
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => 2 // nominal blm benar untuk outputnya, namun ngirim datanya sudah bener
            ],
            'customer_details' => [
                'first_name' => $getName,
                'phone' => $getPhone
            ],
        ];
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json(['snapToken' => $snapToken]);
    }

    public function topup_post(Request $request)
    {
        $user = Auth::user();
        $getId = $user->id;
        $nominal = $request->nominal;
        $date = Carbon::now();
        // Bayar pake midtrans
        $json = json_decode($request->get('json'));
        $status = $json->transaction_status == 'settlement' ? 'diproses' : 'pending';
        // dd($status);
        DB::beginTransaction();
        try {
            $data = Auth::user()
                ->topups()
                ->create([
                    'user_id' => $getId,
                    'nominal' => $nominal,
                    'status' => $status,
                    'date' => $date,
                ]);
            $data->save();
            // $user->keranjangs()->detach($barangs); remove object from storage
            DB::commit();
            return Redirect::route('user.topup.index', ['tipe' => 'pending']);
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e);

            return Redirect::back()->withException($e);
        }
    }
}
