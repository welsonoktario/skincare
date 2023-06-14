<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangPengecekan;
use App\Models\Kandungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangPengecekanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangPengecekans = BarangPengecekan::with('kandungans')->get();
        $barangPengecekans = $barangPengecekans->map(function ($barang) {
            $kandungans = "";

            foreach ($barang->kandungans as $kandungan) {
                $kandungans .= "{$kandungan->nama}, ";
            }

            $kandungans = rtrim($kandungans, ', ');

            $barang->kandungans = $kandungans;
            return $barang;
        });

        return view('admin.barang-pengecekan.index', compact('barangPengecekans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kandungans = Kandungan::all();

        return view('admin.barang-pengecekan.create', compact('kandungans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $foto = $request->file('foto')->store('img/barang-pengecekan', 'public');

        $barangPengecekan = BarangPengecekan::query()
            ->create([
                'nama' => $request->nama,
                'foto' => $foto,
            ]);
        $barangPengecekan->kandungans()->attach($request->kandungans);

        return redirect()->back();
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
        $barangPengecekan = BarangPengecekan::query()
            ->with('kandungans')
            ->find($id);

        return view('admin.barang-pengecekan.edit', compact('kandungans', 'barangPengecekan'));
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
        $barangPengecekan = BarangPengecekan::find($id);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            if ($storage->exists($barangPengecekan->path)) {
                $storage->delete($barangPengecekan->path);
            }

            $path = $foto->store('img/barang-pengecekan', 'public');

            $barangPengecekan->update([
                'name' => $request->nama,
                'foto' => $path,
            ]);
            $barangPengecekan->kandungans()->sync($request->kandungans);
        } else {
            $barangPengecekan->update([
                'name' => $request->nama,
            ]);
            $barangPengecekan->kandungans()->sync($request->kandungans);
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
        $barangPengecekan = BarangPengecekan::query()
            ->findOrFail($id);

        $barangPengecekan->kandungans()->detach();
        $barangPengecekan->delete();

        return redirect()->back();
    }
}
