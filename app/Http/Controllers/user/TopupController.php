<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Topup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
