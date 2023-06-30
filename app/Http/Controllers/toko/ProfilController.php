<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Toko;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toko = Toko::firstWhere('id', Auth::user()->toko->id);

        return view('toko.profil.index', compact('toko'));
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
        $toko = Toko::query()
            ->with('kota.provinsi')
            ->find($id);
        $provinsis = Provinsi::all();
        $kotas = Kota::where('provinsi_id', $toko->kota->provinsi_id)->get();

        return view('toko.profil.edit', compact('toko', 'kotas', 'provinsis'));
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
        $toko = Toko::query()->find($id);

        DB::beginTransaction();
        try {
            $toko->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'kota_id' => $request->kota,
            ]);

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $storage = Storage::disk('public');

                if ($storage->exists($toko->foto)) {
                    $storage->delete(($toko->foto));
                }

                $path = $foto->store('img/toko', 'public');
                $toko->update(['foto' => $path]);
            }

            DB::commit();
            alert()->success('Sukses', 'Profil toko berhasl diubah');
        } catch (Throwable $e) {
            DB::rollBack();
            alert()->error('Gagal', 'Terjadi kesalahan mengubah profil toko');
        }

        return redirect()->back();
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
