<?php

namespace App\Http\Controllers\user;

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
        $interaksis = [];
        $keranjangs = Auth::user()
            ->keranjangs()
            ->get();

        foreach ($keranjangs as $barang) {
            $barang['checkoutable'] = $barang->pivot->jumlah <= $barang->stok;
        }

        self::cekInteraksi($keranjangs);

        $keranjangs = $keranjangs->groupBy('toko.nama');

        $total = $keranjangs->sum(function ($keranjang) {
            return $keranjang->sum(function ($barang) {
                return $barang->pivot->sub_total;
            });
        });

        return view('user.keranjang.index', compact('keranjangs', 'total'));
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
        // dd($keranjangs);
        $pasangan = collect([]);

        foreach ($keranjangs as $barang) {
            if (!$barang->kandungan_id) {
                continue;
            }

            foreach ($keranjangs as $barang2) {
                if (!$barang2->kandungan_id) {
                    continue;
                }

                if ($barang->kandungan_id !== $barang2->kandungan_id) {
                    $tmp = collect([$barang->kandungan_id, $barang2->kandungan_id])->sort();

                    if (!in_array($tmp->values()->toArray(), $pasangan->values()->toArray())) {
                        $pasangan->add($tmp);
                    }
                }
            }
        }

        $pasangan = $pasangan->values()->all();

        foreach($pasangan as $p) {
            $hasilInteraksi = DB::table('interaksi_kandungans')
                ->whereRaw('kandungan_satu_id = ? AND kandungan_dua_id = ?', [$p[0], $p[1]])
                ->orWhereRaw('kandungan_satu_id = ? AND kandungan_dua_id = ?', [$p[1], $p[0]])
                ->get();
            dump($hasilInteraksi);
        }
    }
}
