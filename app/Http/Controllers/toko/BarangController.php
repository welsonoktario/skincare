<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Etalase;
use App\Models\Kandungan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $kandungans = Kandungan::all();
        $etalases = Etalase::where('toko_id', Auth::user()->toko->id)->get();
        $barangs = Barang::where('toko_id', Auth::user()->toko->id)->get();
        return view('toko.barang.create', compact('barangs', 'etalases', 'kategoris', 'kandungans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $toko = Auth::user()->toko;
        $kandungans = $request->kandungans;
        $fotos = $request->file('fotos');

        $barang = $toko->barangs()->create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'berat' => $request->berat,
            'jenis_diskon' => $request->jenis_diskon,
            'nominal_diskon' => $request->nominal_diskon,
            'kategori_id' => $request->kategori,
            'etalase_id' => $request->etalase == 'semua' ? null : $request->etalase,
        ]);

        $barang->kandungans()->sync($kandungans);

        foreach ($fotos as $foto) {
            $path = $foto->store('img/barang', 'public');
            $barang->fotos()->create([
                'path' => "/storage/{$path}"
            ]);
        }

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
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori,
            'etalase_id' => $request->etalase == 'semua' ? null : $request->etalase,
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
