<?php

namespace App\Http\Controllers\Admin;

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
        $toko = Toko::query()
            ->with(['kota.provinsi'])
            ->find($id);

        return view('admin.verifikasitoko.show', compact('toko'));
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
                alert()->success('Sukses', "Verifikasi Toko  '{$verifikasitokos->nama}' berhasil ditolak");
                return redirect()->route('admin.verifikasitoko.index');
            } catch (Throwable $e) {
                alert()->success('Sukses', 'Terjadi kesalahan sistem');
                return redirect()->route('admin.verifikasitoko.index');
            }
        } elseif ($request->aksi == 'diterima') {
            try {
                $verifikasitokos->update(['status' => 'diterima']);
                alert()->success('Sukses', "Verifikasi Toko  '{$verifikasitokos->user->nama}' berhasil diterima");
                return redirect()->route('admin.verifikasitoko.index');
            } catch (Throwable $e) {
                alert()->success('Sukses', 'Terjadi kesalahan sistem');
                return redirect()->route('admin.verifikasitoko.index');
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
