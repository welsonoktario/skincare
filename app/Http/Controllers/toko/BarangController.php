<?php

namespace App\Http\Controllers\toko;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Etalase;
use App\Models\Kategori;
use Auth;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // nampilin barang yang status = diterima atau pending
        // $barangs = Barang::whereIn('status', ['diterima', 'pending'])->where('toko_id', Auth::user()->toko->id)->get();

        // tampilkan semua barang yang status = diterima dari toko
        // $barangs = Barang::where('status', 'diterima')->where('toko_id', Auth::user()->toko->id)->get();

        // tampilkan semua barang dari toko
        $barangs = Barang::where('toko_id', Auth::user()->toko->id)->get();

        return view('toko.barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $etalases = Etalase::where('toko_id', Auth::user()->toko->id)->get();
        $barangs = Barang::where('toko_id', Auth::user()->toko->id)->get();
        return view('toko.barang.create', compact('barangs', 'etalases', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barangs = Barang::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'berat' => $request->berat,
            'kategori_id' => $request->kategoris,
            'etalase_id' => $request->etalases,
            'toko_id' => Auth::user()->toko->id
        ]);
        // Alert::success('Sukses');
        return redirect()->route('toko.barang.index')->with('toast_success', 'Barang telah ditambah');
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
        $barangs = Barang::find($id);
        return view('toko.barang.edit', compact('barangs'));
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
        $barangs = Barang::find($id);

        $barangs->update([
            //'nama' -> dipanggil di view edit (id, label), sedangkan $request->nama ini diambil dari nama database
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('toko.barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barangs = Barang::whereId($id)->firstOrFail();
        $namaBarangs = $barangs->nama;
        $barangs->delete();

        return redirect()->route('toko.barang.index')->with('success', 'Barang dengan nama ' . $namaBarangs . ' telah dihapus');
    }
}
