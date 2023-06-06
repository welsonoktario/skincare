<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Toko;
use Illuminate\Http\Request;
use Throwable;

class VerifikasiTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verifikasitokos = Toko::where('status', 'pending')->get();
        return view('admin.verifikasitoko.index', compact('verifikasitokos'));
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
        $verifikasitokos = Toko::find($id);

        if ($request->aksi == 'ditolak') {
            try {
                $verifikasitokos->update(['status' => 'ditolak']);
                Toko::destroy($verifikasitokos->id);
                return redirect()->route('admin.verifikasitoko.index')->with('success', "Verifikasi Toko  '{$verifikasitokos->nama}' berhasil ditolak");
            } catch (Throwable $e) {
                return redirect()->route('admin.verifikasitoko.index')->with('fail', 'Terjadi kesalahan sistem');
            }
        } elseif ($request->aksi == 'diterima') {
            try {
                $verifikasitokos->update(['status' => 'diterima']);
                return redirect()->route('admin.verifikasitoko.index')->with('success', "Verifikasi Toko  '{$verifikasitokos->user->nama}' berhasil diterima");
            } catch (Throwable $e) {
                return redirect()->route('admin.verifikasitoko.index')->with('fail', 'Terjadi kesalahan sistem');
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
