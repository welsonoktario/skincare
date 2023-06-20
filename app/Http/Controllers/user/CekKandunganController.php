<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BarangPengecekan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CekKandunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $barangs = BarangPengecekan::all();
        $hasilInteraksis = collect([]);
        $namaBarangs = collect([]);

        if ($request->has('barangs')) {
            // dd($request->barangs);
            $barangCek = BarangPengecekan::query()
                ->whereIn('id', $request->barangs)
                ->get();
            $namaBarangs->add($barangCek[0]->nama);
            $namaBarangs->add($barangCek[1]->nama);
            $hasilInteraksis = self::cekInteraksi($barangCek);
        }

        return view('user.cek-kandungan.index', compact('barangs', 'hasilInteraksis', 'namaBarangs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barangPengecekan = BarangPengecekan::find($id);

        return response()->json($barangPengecekan);
    }

    /**
     * @param App\Models\BarangPengecekan[] /$ids
     */
    private function cekInteraksi($barangs)
    {
        $pasangan = collect([]);
        $barangs = $barangs->sortBy('id');

        $kandunganBarang1 = $barangs[0]->kandungans;
        $kandunganBarang2 = $barangs[1]->kandungans;

        if (count($kandunganBarang1) == 0 || count($kandunganBarang2) == 0) {
            return $pasangan;
        }

        foreach ($kandunganBarang1 as $kb1) {
            foreach ($kandunganBarang2 as $kb2) {
                if ($kb1->id == $kb2->id) {
                    continue;
                }

                $tmp = collect([
                    [
                        'barang' => $barangs[0]->nama,
                        'id_barang' => $barangs[0]->id,
                        'kandungan' => $kb1->id
                    ],
                    [
                        'barang' => $barangs[1]->nama,
                        'id_barang' => $barangs[1]->id,
                        'kandungan' => $kb2->id
                    ]
                ]);
                $tmp = $tmp->sortBy('kandungan');
                $tmp = collect(["k1", "k2"])->combine($tmp);

                if (!str_contains($pasangan->toJson(), $tmp->toJson())) {
                    $pasangan->add($tmp);
                }
            }
        }

        $hasilInteraksis = collect([]);

        foreach($pasangan as $p) {
            $hasilInteraksi = DB::table('interaksi_kandungans', 'ik')
                ->selectRaw(
                    'ik.jenis_interaksi AS jenis_interaksi,
                    ik.deskripsi_interaksi AS deskripsi_interaksi,
                    ik.sumber AS sumber,
                    k1.id AS k1,
                    k2.id AS k2,
                    k1.nama AS kandungan_satu,
                    k2.nama AS kandungan_dua,
                    b1.nama AS barang_satu,
                    b2.nama AS barang_dua'
                )
                ->fromRaw(
                    "interaksi_kandungans AS ik
                    INNER JOIN kandungans AS k1 ON k1.id = ik.kandungan_satu_id
                    INNER JOIN kandungans AS k2 ON k2.id = ik.kandungan_dua_id
                    INNER JOIN barang_pengecekans AS b1 ON b1.id = ?
                    INNER JOIN barang_pengecekans AS b2 ON b2.id = ?",
                    [
                        intval($barangs[0]->id),
                        intval($barangs[1]->id),
                    ]
                )
                ->whereRaw("ik.kandungan_satu_id = {$p['k1']['kandungan']} AND ik.kandungan_dua_id = {$p['k2']['kandungan']}")
                ->first();

            if ($hasilInteraksi) {
                // tambah nama pasangan barang ex: "nivea + vaseline"
                $hasilInteraksi->nama = $hasilInteraksi->barang_satu. ' + ' . $hasilInteraksi->barang_dua;
                // hasil interaksi ditambah ke array $hasilInteraksis
                if (!str_contains($hasilInteraksis->toJson(), json_encode($hasilInteraksi))) {

                    // cek jika sebelumnya sudah ada hasil interaksi yang kandungan_satu_id dan kandungan_dua_id
                    // sama seperti hasil query yang didapatkan
                    $contains = $hasilInteraksis->contains(function ($hi) use ($hasilInteraksi) {
                        return $hi->k1 == $hasilInteraksi->k1 && $hi->k2 == $hasilInteraksi->k2 && $hi->barang_satu == $hasilInteraksi->barang_satu && $hi->barang_dua == $hasilInteraksi->barang_dua;
                    });

                    if (!$contains) {
                        $hasilInteraksis->add($hasilInteraksi);
                    }
                }
            }
        }
        $hasil = collect([]);
        $hasilNama = $hasilInteraksis->groupBy('nama');

        foreach ($hasilNama as $i => $group) {
            // jika tiap kelompok nama gabungan barang ada interaksi buruk
            if ($group->contains('jenis_interaksi', 'buruk')) {
                // ambil/tampilkan yang buruk aja
                $hasilNama[$i] = $group->filter(function ($hi) {
                    return $hi->jenis_interaksi == 'buruk';
                });
            }
        }

        foreach ($hasilNama as $i => $group) {
            foreach ($group as $hi) {
                $hasil->add($hi);
            }
        }

        $hasilInteraksis = $hasil->groupBy('jenis_interaksi');

        return $hasilInteraksis;
    }
}
