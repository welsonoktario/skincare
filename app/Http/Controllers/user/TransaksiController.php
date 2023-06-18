<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipe = $request->tipe ?: 'semua';
        $transaksis = Auth::user()->transaksis()
            ->with(['transaksiDetails.barang', 'toko'])
            ->when(($tipe != 'semua'), fn (Builder $q) => $q->where('status', $tipe))
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('user.riwayat.index', compact('transaksis'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::query()
            ->with(['transaksiDetails.barang'])
            ->find($id);

        return view('user.riwayat.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $pesananmasuk = Transaksi::find($id);
        $status = ['selesai', 'dikembalikan'];

        if (in_array($request->aksi, $status)) {
            $pesananmasuk->update(['status' => $request->aksi]);
        }

        return redirect()->back();
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
