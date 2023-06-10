<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Penarikan;
use App\Models\Toko;
use Auth;
use Illuminate\Http\Request;
use Throwable;

class VerifikasiPenarikanToko extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penarikantoko = Penarikan::where('asal_penarikan','toko')->where('status','pending')->get();
        // $toko = Toko::firstWhere('user', Auth::user('id')->toko->id);
        // $toko = Penarikan::firstWhere('user_id', Auth::user('id')->toko->id)->get();
        // $penarikans->user->toko;
        return view('admin.verifikasipenarikantoko.index',compact('penarikantoko'));
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
        $penarikantoko = Penarikan::find($id);
        $toko = $penarikantoko->user->toko;

        if ($request->aksi == 'ditolak') {
            try {
                $penarikantoko->update(['status' => 'ditolak']);
                return redirect()->route('admin.penarikantoko.index')->with('success', "Verifikasi Penarikan  '{$penarikantoko->id}' berhasil ditolak");
            } catch (Throwable $e) {
                return redirect()->route('admin.penarikantoko.index')->with('fail', 'Terjadi kesalahan sistem');
            }
        } elseif ($request->aksi == 'diterima') {
            try {
                $toko->update(['saldo'=>$toko->saldo - $penarikantoko->nominal]);
                $penarikantoko->update(['status' => 'diterima']);
                return redirect()->route('admin.penarikantoko.index')->with('success', "Verifikasi Penarikan  '{$penarikantoko->ud}' berhasil diterima");
            } catch (Throwable $e) {
                return redirect()->route('admin.penarikantoko.index')->with('fail', 'Terjadi kesalahan sistem');
            }
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
