<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Etalase;
use App\Models\Kandungan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

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

        DB::beginTransaction();
        try {
            $barang = $toko->barangs()->create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'berat' => $request->berat,
                'jenis_diskon' => $request->jenis_diskon,
                'nominal_diskon' => $request->nominal_diskon,
                'kategori_id' => $request->kategori != 'lainnya' ? $request->kategori : null,
                'etalase_id' => $request->etalase == 'semua' ? null : $request->etalase,
            ]);

            $barang->kandungans()->sync($kandungans);

            foreach ($fotos as $foto) {
                $path = $foto->store('img/barang', 'public');
                $barang->fotos()->create([
                    'path' => $path
                ]);
            }

            DB::commit();

            alert()->success('Sukses', 'Barang berhasil ditambahkan');
        } catch (Throwable $e) {
            DB::rollBack();
            alert()->error('Error', 'Terjadi kesalahan menambah barang');
        }

        return redirect()->route('toko.barang.index');
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
        $kategoris = Kategori::all();
        $kandungans = Kandungan::all();
        $etalases = Etalase::where('toko_id', Auth::user()->toko->id)->get();
        $barang = Barang::find($id);
        $hargaDiskon = null;

        if ($barang->nominal_diskon) {
            $hargaDiskon = $barang->jenis_diskon == 'persen'
                ? ($barang->harga - ($barang->harga * ($barang->nominal_diskon / 100)))
                : $barang->harga - $barang->nominal_diskon;
        }

        return view('toko.barang.edit', compact('barang', 'kategoris', 'kandungans', 'etalases', 'hargaDiskon'));
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
        $barang = Barang::query()->find($id);
        $kandungans = $request->kandungans;
        $fotos = $request->file('fotos');

        DB::beginTransaction();
        try {
            $barang->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'berat' => $request->berat,
                'jenis_diskon' => $request->jenis_diskon ?: null,
                'nominal_diskon' => $request->nominal_diskon ?: null,
                'kategori_id' => $request->kategori != 'lainnya' ? $request->kategori : null,
                'etalase_id' => $request->etalase == 'semua' ? null : $request->etalase,
            ]);

            $barang->kandungans()->sync($kandungans);

            if ($fotos) {
                foreach ($barang->fotos as $foto) {
                    if ($storage->exists($foto->path)) {
                        $storage->delete($foto->path);
                        $foto->delete();
                    }
                }

                foreach ($fotos as $foto) {
                    $path = $foto->store('img/barang', 'public');
                    $barang->fotos()->create([
                        'path' => $path
                    ]);
                }
            }
            DB::commit();

            alert()->success('Sukses', 'Barang berhasil ditambahkan');
        } catch (Throwable $e) {
            DB::rollBack();
            alert()->error('Gagal', 'Terjadi kesalahan menambah barang');
        }

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
        $delete = $barangs->delete();

        if ($delete) {
            alert()->success('Sukses', 'Barang berhasil dihapus');
        } else {
            alert()->error('Gagal', 'Terjadi kesalahan menghapus barang');
        }

        return redirect()->route('toko.barang.index');
    }

    public function loadFotos($id)
    {
        $storage = Storage::disk('public');
        $fotos = Barang::query()
            ->find($id)
            ->fotos
            ->pluck('path');
        $fotos = $fotos->map(function ($path) use ($storage) {
            return $storage->url($path);
        });

        return response()->json($fotos);
    }
}
