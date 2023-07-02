<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

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
            ->with(['transaksiDetails.barang', 'pengembalian', 'alamat.kota.provinsi'])
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
            ->with(['transaksiDetails', 'toko'])
            ->find($id);

        if ($request->aksi == 'selesai') {
            DB::beginTransaction();

            try {
                $transaksi->update(['status' => $request->aksi]);
                $transaksi->toko()->update([
                    'saldo' => $transaksi->toko->saldo + $transaksi->total_harga + $transaksi->ongkos_pengiriman
                ]);

                DB::commit();
                alert()->success('Berhasil', 'Transaksi anda telah selesai, mohon berikan ulasan transaksi anda');

                return redirect()->route('user.transaksi.index', ['tipe' => 'selesai']);
            } catch(Throwable $e) {
                DB::rollBack();
                alert()->error('Gagal', 'Terjadi kesalahan memproses transaksi anda');

                return redirect()->route('user.transaksi.index', ['tipe' => 'dikirim']);
            }
        }

        if ($request->has('lanjutkan')) {
            DB::beginTransaction();

            try {
                foreach (json_decode($transaksi->transaksi_ids) as $id) {
                    Transaksi::query()->find($id)->update(['status' => 'menunggu konfirmasi']);
                }

                DB::commit();
                alert()->success('Sukses', 'Pembayaran anda berhasil dikonfirmasi');

                return redirect()->route('user.transaksi.index', ['tipe' => 'diproses']);
            } catch (Throwable $e) {
                DB::rollBack();
                alert()->errorr('Gagal', 'Terjadi kesalahan mengonfirmasi pembayaran anda');

                return redirect()->route('user.transaksi.index', ['tipe' => 'menunggu konfirmasi']);
            }
        }

        if ($request->has('ulasan')) {
            // dd($request->all());
            $ratings = $request->ratings;
            $komentars = $request->komentars;

            DB::beginTransaction();
            try {
                foreach ($transaksi->transaksiDetails as $td) {
                    if (isset($ratings[$td->id])) {
                        $td->ulasan()->create([
                            'komentar' => $komentars[$td->id],
                            'rating' => $ratings[$td->id]
                        ]);
                    }
                }

                DB::commit();
                alert()->success('Sukses', 'Berhasil menambahkan ulasan barang');
            } catch (Throwable $e) {
                DB::rollBack();
                alert()->error('Gagal', 'Terjadi kesalahan menambahkan ulasan barang');
            }

            return redirect()->route('user.transaksi.index', ['tipe' => '']);
        }

        if ($request->has('pengembalian')) {
            try {
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
                DB::commit();
                alert()->success('Sukses', 'Berhasil mengajukan pengembalian barang. Mohon tunggu konfirmasi dari toko');

                return redirect()->route('user.transaksi.index', ['tipe' => 'dikembalikan']);
            } catch (Throwable $e) {
                DB::rollBack();
                alert()->error('Gagal', 'Terjadi kesalahan mengajukan pengembalian barang');

                return redirect()->route('user.transaksi.index', ['tipe' => 'dikirim']);
            }
        }
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
