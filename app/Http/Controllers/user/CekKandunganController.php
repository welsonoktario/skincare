<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
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
        $barangs = Barang::all();
        $hasilInteraksis = collect([]);
        $namaBarangs = collect([]);

        if ($request->has('barangs')) {
            // dd($request->barangs);
            $barangCek = Barang::query()
                ->whereIn('id', $request->barangs)
                ->get();
            $namaBarangs->add($barangCek[0]->nama);
            $namaBarangs->add($barangCek[1]->nama);
            $hasilInteraksis = self::cekInteraksi($barangCek);
        }

        return view('user.cek-kandungan.index', compact('barangs', 'hasilInteraksis', 'namaBarangs'));
    }

    /**
     * @param App\Models\Barang[] /$ids
     */
    private function cekInteraksi($barangs)
    {
        $pasangan = collect([]);
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
                        'kandungan' => $kb1->id
                    ],
                    [
                        'barang' => $barangs[1]->nama,
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
                if (!str_contains($hasilInteraksis->toJson(), json_encode($hasilInteraksi))) {
                    $contains = $hasilInteraksis->contains(function ($hi) use ($p) {
                        return $hi->k1 == $p['k1']['kandungan'] && $hi->k2 == $p['k2']['kandungan'];
                    });

                    if (!$contains) {
                        $hasilInteraksis->add($hasilInteraksi);
                    }
                }
            }
        }

        $hasilInteraksis = $hasilInteraksis->groupBy('jenis_interaksi');

        return $hasilInteraksis;
    }
}
