<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangKandungan;
use App\Models\Kandungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangKandunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangKandungans = BarangKandungan::all();

        return view('admin.barangkandungan.index', compact('barangKandungans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kandungans = Kandungan::all();

        return view('admin.barangkandungan.create', compact('kandungans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $foto = $request->file('foto')->store('img/barang-kandungan', 'public');

        BarangKandungan::query()
            ->create([
                'nama' => $request->nama,
                'foto' => $foto,
                'kandungan_id' => $request->kandungan,
            ]);

        return redirect()->back();
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
        $kandungans = Kandungan::all();
        $barangKandungan = BarangKandungan::find($id);

        return view('admin.barangkandungan.edit', compact('kandungans', 'barangKandungan'));
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
        $storage = Storage::disk('public');
        $barangKandungan = BarangKandungan::find($id);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');

            if ($storage->exists($barangKandungan->path)) {
                $storage->delete($barangKandungan->path);
            }

            $path = $icon->store('img/barang-kandungan', 'public');

            $barangKandungan->update([
                'name' => $request->nama,
                'foto' => $path,
            ]);
        } else {
            $barangKandungan->update([
                'name' => $request->nama,
            ]);
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
