<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $pasangan = collect([]);

        // bikin pasangan kandungan yang tidak berulang-ulang
        foreach ($keranjangs as $barang) {
            if (!$barang->kandungan_id) {
                continue; // skip kalo barang1 gaada kandungan
            }

            foreach ($keranjangs as $barang2) {
                if (!$barang2->kandungan_id) {
                    continue; // skip kalo barang2 gaada kandungan
                }

                // cek jika kandungan barang1 sama barang2 beda
                // kalo kandungan barang1 & barang2 sama, skip, ngulang loop
                if ($barang->kandungan_id != $barang2->kandungan_id) {
                    $tmp = collect([
                        [
                            'barang' => $barang->nama, // nivea
                            'kandungan' => $barang->kandungan_id  // 3
                        ],
                        [
                            'barang' => $barang2->nama, // vaseline
                            'kandungan' => $barang2->kandungan_id // 2
                        ]
                    ]);
                    /*
                        $tmp = [
                            [
                                'barang' => nivea,
                                'kandungan' => 3
                            ],
                            [
                                'barang' => vaseline
                                'kandungan' => 2
                            ]
                        ]
                    */

                    $tmp = $tmp->sortBy('kandungan'); // urutkan berdasarkan kandungan_id
                    /*
                        $tmp = [
                            [
                                'barang' => vaseline,
                                'kandungan' => 2
                            ],
                            [
                                'barang' => nivea
                                'kandungan' => 3
                            ]
                        ]
                    */

                    $tmp = collect(["k1", "k2"])->combine($tmp);
                    /*
                        $tmp = [
                            'k1' => [
                                'barang' => 'vaseline',
                                'kandungan' => 2
                            ],
                            'k2' => [
                                'barang' => 'nivea'
                                'kandungan' => 3
                            ]
                        ]
                    */

                    // cek jika text $tmp dijadikan json (string)
                    // ada didalam text $pasangan dijadikan json (string)

                    // str_contains untuk ngecek apakah sejumlah text (string)
                    // ada didalam text (string) lainnya
                    // ex: "llo w" didalam "hello world" hasilnya true
                    if (!str_contains($pasangan->toJson(), $tmp->toJson())) {
                        $pasangan->add($tmp);
                        /*
                            $pasangan = [
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
                    }
                }
            }
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
        foreach($pasangan as $p) {
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
                    k1.nama AS kandungan_satu,
                    k2.nama AS kandungan_dua'
                )
                // join table interaksi_kandungans dengan table kandungans (k1) yang interaksi_satu_id sama dengan id kandungan
                ->join('kandungans AS k1', 'k1.id', '=', 'ik.kandungan_satu_id')
                // join table interaksi_kandungans dengan table kandungans (k2) yang interaksi_dua_id sama dengan id kandungan
                ->join('kandungans AS k2', 'k2.id', '=', 'ik.kandungan_dua_id')
                // yang dimana kandungan_satu_id = id dari k1 (dari $p) DAN kandungan_satu_id = id dari k2 (dari $p)
                ->whereRaw("ik.kandungan_satu_id = {$p['k1']['kandungan']} AND ik.kandungan_dua_id = {$p['k2']['kandungan']}")
                // ATAU yang dimana kandungan_satu_id = id dari k2 (dari $p) DAN kandungan_satu_id = id dari k1 (dari $p)
                ->orWhereRaw("ik.kandungan_satu_id = {$p['k2']['kandungan']} AND ik.kandungan_dua_id = {$p['k1']['kandungan']}")
                ->first();

            /* HASIL QUERY DIATAS:
                SELECT
                    ik.jenis_interaksi AS jenis_interaksi,
                    ik.deskripsi_interaksi AS deskripsi_interaksi,
                    ik.sumber AS sumber,
                    k1.nama AS kandungan_satu,
                    k2.nama AS kandungan_dua
                FROM interaksi_kandungans AS ik
                    INNER JOIN kandungans AS k1 ON k1.id = ik.kandungan_satu_id
                    INNER JOIN kandungans AS k2 ON k2.id = ik.kandungan_dua_id
                WHERE
                    (ik.kandungan_satu_id = 1 AND ik.kandungan_dua_id = 4) OR
                    (ik.kandungan_satu_id = 4 AND ik.kandungan_dua_id = 1)
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
                ]

            kalo gaada: null
            */

            // kalo hasil interaksi ada di tabel interaksi_kandungans
            if ($hasilInteraksi) {
                $hasilInteraksi->barang_satu = $p['k1']['barang'];
                /*
                    [
                        'jenis_interaksi' => 'baik',
                        'deskripsi_interaksi' => 'bagus aja',
                        'sumber' => 'katanya',
                        'kandungan_satu' => 'AHA',
                        'kandungan_dua' => 'AHB',
                        'barang_satu' => 'scarlett' <-- nama barang 1
                    ]
                */

                $hasilInteraksi->barang_dua = $p['k2']['barang'];
                /*
                    [
                        'jenis_interaksi' => 'baik',
                        'deskripsi_interaksi' => 'bagus aja',
                        'sumber' => 'katanya',
                        'kandungan_satu' => 'AHA',
                        'kandungan_dua' => 'AHB',
                        'barang_satu' => 'scarlett', <-- nama barang 1
                        'barang_dua' => 'vaseline' <-- nama barang2
                    ]
                */

                // hasil interaksi ditambah ke array $hasilInteraksis
                $hasilInteraksis->add($hasilInteraksi);
            }
        }

        return $hasilInteraksis;
    }
}
