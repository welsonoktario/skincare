<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Throwable;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjangs = Auth::user()
            ->keranjangsWithToko()
            ->get()
            ->groupBy('toko.nama');
        $total = $keranjangs->sum(function ($keranjang) {
            return $keranjang->sum(function ($barang) {
                return $barang->pivot->sub_total;
            });
        });

        return view('user.keranjang.index', compact('keranjangs', 'total'));
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
        $keranjangs = Auth::user()->keranjangs();
        $exist = $keranjangs->firstWhere('barang_id', $request->barang);

        if ($exist) {
            $newSubTotal = (($exist->pivot->jumlah + $request->jumlah) * $request->harga);
            $keranjangs->updateExistingPivot($request->barang, [
                'sub_total' => $newSubTotal,
                'jumlah' => $exist->pivot->jumlah + $request->jumlah
            ]);
        } else {
            $keranjangs->attach($request->barang, [
                'sub_total' => $request->harga * $request->jumlah,
                'jumlah' => $request->jumlah
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
        //
    }
}
