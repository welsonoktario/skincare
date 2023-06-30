<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Throwable;

class VerifikasiBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verifikasibarangs = Barang::query()
            ->where('status', 'pending')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.verifikasibarang.index', compact('verifikasibarangs'));
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
        $barang = Barang::query()
            ->with(['etalase', 'kandungans', 'kategori'])
            ->find($id);

        return view('admin.verifikasibarang.show', compact('barang'));
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
        $verifikasibarangs = Barang::find($id);

        if ($request->aksi == 'ditolak') {
            try {
                $verifikasibarangs->update(['status' => 'ditolak']);
                Barang::destroy($verifikasibarangs->id);
                alert()->success('Sukses', "Verifikasi Barang  '{$verifikasibarangs->nama}' berhasil ditolak");
                return redirect()->route('admin.verifikasibarang.index');
            } catch (Throwable $e) {
                alert()->error('Gagal', 'Terjadi kesalahan sistem');
                return redirect()->route('admin.verifikasibarang.index');
            }
        } elseif ($request->aksi == 'diterima') {
            try {
                $verifikasibarangs->update(['status' => 'diterima']);
                alert()->success('Sukses', "Verifikasi Barang  '{$verifikasibarangs->nama}' berhasil diterima");
                return redirect()->route('admin.verifikasibarang.index');
            } catch (Throwable $e) {
                alert()->error('Gagal', 'Terjadi kesalahan sistem');
                return redirect()->route('admin.verifikasibarang.index');
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
