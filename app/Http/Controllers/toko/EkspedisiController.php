<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Ekspedisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class EkspedisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toko = Auth::user()->toko;
        $ekspedisis = Ekspedisi::all();
        $tokoEkspedisis = $toko->ekspedisis;

        return view('toko.ekspedisi.index', compact('ekspedisis', 'tokoEkspedisis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $toko = Auth::user()->toko;
        $ekspedisis = $request->ekspedisis;

        DB::beginTransaction();
        try {
            $toko->ekspedisis()->sync($ekspedisis);
            DB::commit();

            alert()->success('Sukses', 'Pengaturan ekspedisi berhasil disimpan');
        } catch (Throwable $e) {
            DB::rollBack();
            alert()->error('Gagal', 'Terjadi kesalahan menyimpan pengaturan ekspedisi');
        }

        return redirect()->route('toko.ekspedisi.index');
    }
}
