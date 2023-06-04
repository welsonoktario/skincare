<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Auth;
use Illuminate\Http\Request;

class PesananMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesananmasuk = Transaksi::where('status','pending')->where('toko_id', Auth::user()->toko->id)->get();
        return view('toko.pesananmasuk.index',compact('pesananmasuk'));
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
        $pesananmasuk = Transaksi::find($id);
        // $pesananmasuk->update(['status' => $request->aksi]);


        if ($request->aksi == 'diproses') {
            $pesananmasuk->update(['status'=>'diproses']);
            return redirect()->route('toko.pesananmasuk.index')->with('success', 'Pesanan Telah Diterima');
        } else if ($request->aksi == 'batal') {
            $pesananmasuk->update(['status'=>'batal']);
            return redirect()->route('toko.pesananmasuk.index')->with('success', 'Pesanan Telah Ditolak');
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
