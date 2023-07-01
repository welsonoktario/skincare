<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pengembalian;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipe = $request->tipe ?: 'semua';
        $toko = Auth::user()->toko;

        $pesanans = $toko->transaksis()
            ->with([
                'toko',
                'transaksiDetails.barang',
                'transaksiDetails.ulasan',
                'pengembalian'
            ])
            ->when(($tipe != 'semua' && $tipe != 'dikembalikan'), fn (Builder $q) => $q->where('status', $tipe))
            ->when(($tipe == 'dikembalikan'), fn (Builder $q) => $q->has('pengembalian'))
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('toko.pesanan.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            ->with(['transaksiDetails.barang', 'pengembalian', 'alamat.kota.provinsi'])
            ->find($id);

        return view('toko.pesanan.show', compact('transaksi'));
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
        $transaksi = Transaksi::query()
            ->with('pengembalian')
            ->find($id);

        DB::beginTransaction();
        try {

            if ($request->has('pengembalian')) {
                $transaksi->pengembalian()
                    ->update([
                        'status' => $request->aksi
                    ]);

                if ($request->aksi == 'ditolak') {
                    $transaksi->toko()->update([
                        'saldo' => $transaksi->toko->saldo + $transaksi->total_harga + $transaksi->ongkos_pengiriman
                    ]);
                }
            } elseif ($request->aksi == 'pengembalian-selesai') {
                $transaksi->pengembalian()
                    ->update([
                        'status' => 'selesai'
                    ]);

                $transaksi->user()->update([
                    'saldo' => $transaksi->user->saldo + $transaksi->total_harga + $transaksi->ongkos_pengiriman
                ]);

                foreach ($transaksi->transaksiDetails as $td) {
                    $td->barang()->update([
                        'stok' => $td->barang->stok + $td->jumlah,
                    ]);
                }
            } else {
                $status = ['diproses', 'dikirim', 'batal'];
                if (in_array($request->aksi, $status)) {
                    if ($request->aksi == 'batal') {
                        $user = $transaksi->user;
                        $user->update([
                            'saldo' => $user->saldo + $transaksi->total_harga + $transaksi->ongkos_pengiriman
                        ]);

                        foreach ($transaksi->transaksiDetails as $td) {
                            $td->barang()->update([
                                'stok' => $td->barang->stok + $td->jumlah,
                            ]);
                        }
                    }
                    $transaksi->update(['status' => $request->aksi]);
                }
            }
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e->getMessage());
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

    public function pengembalian($id)
    {
        $pengembalian = Pengembalian::query()
            ->with(['transaksi.transaksiDetails.barang'])
            ->firstWhere('transaksi_id', $id);

        return view('toko.pesanan.pengembalian', compact('pengembalian'));
    }
}
