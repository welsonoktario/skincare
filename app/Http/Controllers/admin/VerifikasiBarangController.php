<?php

namespace App\Http\Controllers\admin;

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
        $verifikasibarangs = Barang::where('status', 'pending')->get();
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
        $verifikasibarangs = Barang::find($id);

        if ($request->aksi == 'ditolak') {
            try {
                $verifikasibarangs->update(['status' => 'ditolak']);
                Barang::destroy($verifikasibarangs->id);
                return redirect()->route('admin.verifikasibarang.index')->with('success', "Verifikasi Barang  '{$verifikasibarangs->nama}' berhasil ditolak");
            } catch (Throwable $e) {
                return redirect()->route('admin.verifikasibarang.index')->with('fail', 'Terjadi kesalahan sistem');
            }
        } elseif ($request->aksi == 'diterima') {
            try {
                $verifikasibarangs->update(['status' => 'diterima']);
                return redirect()->route('admin.verifikasibarang.index')->with('success', "Verifikasi Barang  '{$verifikasibarangs->user->nama}' berhasil diterima");
            } catch (Throwable $e) {
                return redirect()->route('admin.verifikasibarang.index')->with('fail', 'Terjadi kesalahan sistem');
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
