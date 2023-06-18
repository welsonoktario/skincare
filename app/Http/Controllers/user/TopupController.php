<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Topup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $saldo = Auth::user()->saldo;

        return view('user.topup.create', compact('saldo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nominal = $request->nominal;
        $topup = Auth::user()
            ->topups()
            ->create(compact('nominal'));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topup = Topup::find($id);

        return view('user.topup.edit', compact('topup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getTopup(Request $request)
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
                'gross_amount' => $request->total,
            ],
            'customer_details' => [
                'first_name' => $getName,
                'phone' => $getPhone
            ],
        ];
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json(['snapToken' => $snapToken]);
    }

    public function processTopup(Request $request)
    {
        //
        $user = Auth::user();
        $getId = $user->id;
        $nominal = $request->nominal;
        $date = Carbon::now();
        // Bayar pake midtrans
        $json = json_decode($request->get('json'));
        $status = $json->transaction_status == 'settlement' ? true : false;
        // dd($status);
        DB::beginTransaction();
        try {
            $data = Auth::user()
                ->topups()
                ->create([
                    'user_id' => $getId,
                    'nominal' => $nominal,
                    'dibayar' => $status,
                ]);
            $data->save();
            // $user->keranjangs()->detach($barangs); remove object from storage
            DB::commit();
            return redirect()->route('user.topup.index', ['tipe' => 'pending']);
        } catch (Throwable $e) {
            DB::rollBack();

            return redirect()->back()->withException($e);
        }
    }
}
