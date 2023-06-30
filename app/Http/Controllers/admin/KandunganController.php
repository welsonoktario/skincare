<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kandungan;
use Illuminate\Http\Request;

class KandunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kandungans = Kandungan::all();

        return view('admin.kandungan.index', compact('kandungans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kandungan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = Kandungan::query()
            ->create([
                'nama' => $request->nama
            ]);

        if ($store) {
            alert()->success('Sukses', 'Data kandungan berhasil ditambahkan');
        } else {
            alert()->error('Gagal', 'Terjadi kesalahan menambah kandungan');
        }

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
        $kandungan = Kandungan::find($id);

        return view('admin.kandungan.edit', compact('kandungan'));
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
        $kandungan = Kandungan::find($id);
        $update = $kandungan->update([
            'nama' => $request->nama
        ]);

        if ($update) {
            alert()->success('Sukses', 'Data kandungan berhasil diubah');
        } else {
            alert()->error('Gagal', 'Terjadi kesalahan mengubah data kandungan');
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
        $delete = Kandungan::query()
            ->find($id)
            ->delete();

        if ($delete) {
            alert()->success('Sukses', 'Data kandungan berhasil dihapus');
        } else {
            alert()->error('Gagal', 'Terjadi kesalahan menghapus data kandungan');
        }

        return redirect()->back();
    }
}
