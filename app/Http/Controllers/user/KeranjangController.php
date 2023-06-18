<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Throwable;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // ngambil barang2 di keranjang dari user yang lagi login
        $keranjangs = Auth::user()
            ->keranjangs()
            ->get();

        // cek kandungan
        $kandungans = self::cekInteraksi($keranjangs);

        // cek tiap barang di keranjang user
        // apakah stoknya cukup atau kurang dari stok barang yang dijual
        foreach ($keranjangs as $barang) {
            // kasih tanda tiap barang yang ada di keranjang apakah dapat di-checkout
            $barang['checkoutable'] = $barang->pivot->jumlah <= $barang->stok; // hasilnya true atau false
            // $barang['checkoutable'] = true
            // atau $barang['checkoutable'] = false
        }

        // kelompokkan barang2 di keranjang berdasarkan nama toko
        $keranjangs = $keranjangs->groupBy('toko.nama');

        // hitung total seluruh barang dan jumlah di keranjang user
        $total = $keranjangs->sum(function ($keranjang) {
            return $keranjang->sum(function ($barang) {
                return $barang->pivot->sub_total;
            });
        });

        return view('user.keranjang.index', compact('keranjangs', 'total', 'kandungans'));
        // return view('user.keranjang.index', compact('keranjangs', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keranjangs = Auth::user()->keranjangs();
        $exist = $keranjangs->firstWhere('barang_id', $request->barang);

        if ($exist) {
            $newSubTotal = (($exist->pivot->jumlah + $request->jumlah) * $request->harga);
            $keranjangs->updateExistingPivot($request->barang, [
                'sub_total' => $newSubTotal,
                'jumlah' => $exist->pivot->jumlah + $request->jumlah,
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ]);
        } else {
            $keranjangs->attach($request->barang, [
                'sub_total' => $request->harga * $request->jumlah,
                'jumlah' => $request->jumlah,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Barang berhasil ditambahkan ke keranjang');
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
        $keranjangs = Auth::user()->keranjangs();

        try {
            $keranjangs->syncWithPivotValues([$request->barang], [
                'sub_total' => $request->subtotal,
                'jumlah' => $request->jumlah,
            ], false);

            $total = (int) $keranjangs->sum('sub_total');

            return Response::json([
                'status' => 'OK',
                'data' => compact('total'),
            ]);
        } catch (Throwable $e) {
            return Response::json([
                'status' => 'FAIL',
                'msg' => $e->getMessage(),
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
        Auth::user()->keranjangs()->detach([$id]);

        return redirect()->back();
    }

    private function cekInteraksi($keranjangs)
    {
        $pasanganBarangs = collect([]);

        // bikin pasangan kandungan yang tidak berulang-ulang
        foreach ($keranjangs as $barang) {
            $pasangan = collect([]);
            $kandunganBarang1 = $barang->kandungans;

            if (count($kandunganBarang1) == 0) {
                continue; // skip kalo barang1 gaada kandungan
            }

            foreach ($keranjangs as $barang2) {
                if ($barang->id == $barang2->id) {
                    continue;
                }

                $kandunganBarang2 = $barang2->kandungans;

                if (count($kandunganBarang2) == 0) {
                    continue; // skip kalo barang2 gaada kandungan
                }

                // buat pasangan kandungan tiap barang (step 5)
                foreach ($kandunganBarang1 as $kb1) {
                    foreach ($kandunganBarang2 as $kb2) {

                        // cek jika kandungan barang1 sama barang2 beda
                        // kalo kandungan barang1 & barang2 sama, skip, ngulang loop
                        if ($kb1->id == $kb2->id) {
                            continue;
                        }

                        $tmp = collect([
                            [
                                'barang' => $barang->nama,
                                'id_barang' => $barang->id,
                                'kandungan' => $kb1->id
                            ],
                            [
                                'barang' => $barang2->nama,
                                'id_barang' => $barang2->id,
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
            }

            $pasanganBarangs->add($pasangan);
        }

        $hasilInteraksis = collect([]);
        // ambil hasil interaksi dari tiap pasangan kandungan
        /*
            $pasangan = [
                [
                    'k1' => [
                        'barang' => 'scarlett',
                        'kandungan' => 1
                    ],
                    'k2' => [
                        'barang' => 'vaseline'
                        'kandungan' => 2
                    ]
                ],
                [
                    'k1' => [
                        'barang' => 'scarlett',
                        'kandungan' => 1
                    ],
                    'k2' => [
                        'barang' => 'nivea'
                        'kandungan' => 3
                    ]
                ],
                [
                    'k1' => [
                        'barang' => 'vaseline',
                        'kandungan' => 2
                    ],
                    'k2' => [
                        'barang' => 'nivea'
                        'kandungan' => 3
                    ]
                ]
            ]
        */
        foreach($pasanganBarangs as $pasangan) {
            foreach ($pasangan as $p) {
                /*
                    $p = [
                        'k1' => [
                            'barang' => 'scarlett',
                            'kandungan' => 1
                        ],
                        'k2' => [
                            'barang' => 'vaseline'
                            'kandungan' => 2
                        ]
                    ],
                */
                $hasilInteraksi = DB::table('interaksi_kandungans', 'ik') // FROM interaksi_kandungans AS ik
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
                        INNER JOIN barangs AS b1 ON b1.id = ? OR b1.id = ?
                        INNER JOIN barangs AS b2 ON b2.id = ? OR b2.id = ?",
                        [
                            //mengambil id barang dari pasangan
                            intval($p['k1']['id_barang']), // "1" ubah jadi 1
                            intval($p['k2']['id_barang']), // "2" ubah jadi 2
                            intval($p['k2']['id_barang']),
                            intval($p['k1']['id_barang'])
                        ]
                    )
                    // yang dimana kandungan_satu_id = id dari k1 (dari $p) DAN kandungan_satu_id = id dari k2 (dari $p)
                    ->whereRaw("ik.kandungan_satu_id = {$p['k1']['kandungan']} AND ik.kandungan_dua_id = {$p['k2']['kandungan']}")
                    // ATAU yang dimana kandungan_satu_id = id dari k2 (dari $p) DAN kandungan_satu_id = id dari k1 (dari $p)
                    // ->orWhereRaw("ik.kandungan_satu_id = {$p['k2']['kandungan']} AND ik.kandungan_dua_id = {$p['k1']['kandungan']}")
                    ->first();

                /* HASIL QUERY DIATAS:
                    SELECT
                        ik.jenis_interaksi AS jenis_interaksi,
                        ik.deskripsi_interaksi AS deskripsi_interaksi,
                        ik.sumber AS sumber,
                        k1.nama AS kandungan_satu,
                        k2.nama AS kandungan_dua,
                        b1.nama AS barang_satu,
                        b2.nama AS barang_dua
                    FROM interaksi_kandungans AS ik
                        INNER JOIN kandungans AS k1 ON k1.id = ik.kandungan_satu_id
                        INNER JOIN kandungans AS k2 ON k2.id = ik.kandungan_dua_id
                        INNER JOIN barangs AS b1 ON b1.id = 1
                        INNER JOIN barangs AS b2 ON b2.id = 2
                    WHERE
                        (ik.kandungan_satu_id = 1 AND ik.kandungan_dua_id = 4)
                    LIMIT 1
                */

                /*
                kalo ada hasil interaksi di db:
                    [
                        'jenis_interaksi' => 'baik',
                        'deskripsi_interaksi' => 'bagus aja',
                        'sumber' => 'katanya',
                        'kandungan_satu' => 'AHA',
                        'kandungan_dua' => 'AHB'
                        'barang_satu' => 'scarlett',
                        'barang_dua' => 'vaseline'
                    ]

                kalo gaada: null
                */

                // kalo hasil interaksi ada di tabel interaksi_kandungans
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
        }

        // kelompokkan hasil interaksi berdasarkan gabungan nama barang ex: "nivea + vaseline"
        $hasilInteraksis = $hasilInteraksis->groupBy('nama');

        foreach ($hasilInteraksis as $i => $group) {
            // jika tiap kelompok nama gabungan barang ada interaksi buruk
            if ($group->contains('jenis_interaksi', 'buruk')) {
                // ambil/tampilkan yang buruk aja
                $hasilInteraksis[$i] = $group->filter(function ($hi) {
                    return $hi->jenis_interaksi == 'buruk';
                });
            }
        }

        return $hasilInteraksis;
    }
}
