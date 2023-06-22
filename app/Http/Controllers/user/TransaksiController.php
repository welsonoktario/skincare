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
            ->with([
                'transaksiDetails' => function ($q) {
                    return $q->with('barang')->doesntHave('ulasan');
                },
                'pengembalian'
            ])
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
        $transaksi = Transaksi::query()
            ->with('transaksiDetails')
            ->find($id);
        $status = ['selesai', 'dikembalikan'];

        if (in_array($request->aksi, $status)) {
            $transaksi->update(['status' => $request->aksi]);
        }

        if ($request->has('ulasan')) {
            // dd($request->all());
            $ratings = $request->ratings;
            $komentars = $request->komentars;

            foreach ($transaksi->transaksiDetails as $i => $td) {
                if (isset($ratings[$td->id])) {
                    $td->ulasan()->create([
                        'komentar' => $komentars[$td->id],
                        'rating' => $ratings[$td->id]
                    ]);
                }
            }
        }

        if ($request->has('pengembalian')) {
            $fotos = $request->file('fotos');
            $fotoPengembalians = [];

            $transaksi->update([
                'status' => 'selesai'
            ]);

            $pengembalian = $transaksi->pengembalian()->create([
                'alasan' => $request->alasan,
            ]);

            foreach ($fotos as $foto) {
                $path = $foto->store("img/pengembalian/{$pengembalian->id}", 'public');
                $fotoPengembalians[] = [
                    'pengembalian_id' => $pengembalian->id,
                    'path' => $path,
                ];
            }

            $pengembalian->fotoPengembalians()->createMany($fotoPengembalians);
        }

        return redirect()->back();
    }

    public function ulasan($id)
    {
        $transaksi = Transaksi::query()
            ->with([
                'transaksiDetails' => function ($q) {
                    return $q->with('barang')->doesntHave('ulasan');
                }
            ])
            ->find($id);

        return view('user.riwayat.ulasan', compact('transaksi'));
    }

    public function pengembalian($id)
    {
        $transaksi = Transaksi::query()
            ->with('transaksiDetails.barang')
            ->find($id);

        return view('user.riwayat.pengembalian', compact('transaksi'));
    }
}
