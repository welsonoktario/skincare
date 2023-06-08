<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
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
        $kategoris = Kategori::with('barangs')->get();
        $hasilInteraksis = collect([]);

        if ($request->has('barangs')) {
            $barangs = Barang::query()
                ->whereIn('id', $request->barangs)
                ->get();
            $hasilInteraksis = self::cekInteraksi($barangs);
        }

        return view('user.cek-kandungan.index', compact('kategoris', 'hasilInteraksis'));
    }

    /**
     * @param App\Models\Barang[] $barangs
     */
    public function cekInteraksi($barangs)
    {
        $pasangan = collect([]);

        foreach ($barangs as $barang) {
            if (!$barang->kandungan_id) {
                continue;
            }

            foreach ($barangs as $barang2) {
                if (!$barang2->kandungan_id) {
                    continue;
                }

                if ($barang->kandungan_id != $barang2->kandungan_id) {
                    $tmp = collect([
                        [
                            'barang' => $barang->nama,
                            'kandungan' => $barang->kandungan_id
                        ],
                        [
                            'barang' => $barang2->nama,
                            'kandungan' => $barang2->kandungan_id
                        ]
                    ]);

                    $tmp = $tmp->sortBy('kandungan');
                    $tmp = collect(["k1", "k2"])->combine($tmp);

                    if (!str_contains($pasangan->toJson(), $tmp->toJson())) {
                        $pasangan->add($tmp);
                    }
                }
            }
        }

        $hasilInteraksis = collect([]);
        foreach ($pasangan as $p) {
            $hasilInteraksi = DB::table('interaksi_kandungans', 'ik') // FROM interaksi_kandungans AS ik
                ->selectRaw(
                    'ik.jenis_interaksi AS jenis_interaksi,
                    ik.deskripsi_interaksi AS deskripsi_interaksi,
                    ik.sumber AS sumber,
                    k1.nama AS kandungan_satu,
                    k2.nama AS kandungan_dua'
                )
                ->join('kandungans AS k1', 'k1.id', '=', 'ik.kandungan_satu_id')
                ->join('kandungans AS k2', 'k2.id', '=', 'ik.kandungan_dua_id')
                ->whereRaw("ik.kandungan_satu_id = {$p['k1']['kandungan']} AND ik.kandungan_dua_id = {$p['k2']['kandungan']}")
                ->orWhereRaw("ik.kandungan_satu_id = {$p['k2']['kandungan']} AND ik.kandungan_dua_id = {$p['k1']['kandungan']}")
                ->first();

            if ($hasilInteraksi) {
                $hasilInteraksi->barang_satu = $p['k1']['barang'];
                $hasilInteraksi->barang_dua = $p['k2']['barang'];

                $hasilInteraksis->add($hasilInteraksi);
            }
        }
        $hasilInteraksis = $hasilInteraksis->groupBy('jenis_interaksi');

        return $hasilInteraksis;
    }
}
