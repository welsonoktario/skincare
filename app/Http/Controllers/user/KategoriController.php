<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use DB;
use Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();

        return view('user.kategori.index', compact('kategoris'));
    }

    public function show($id)
    {
        $kategori = Kategori::query()
                ->with('barangs')
                ->find($id);

        $barangs = $kategori->barangs()
            ->paginate(4)
            ->withQueryString();

        return view('user.kategori.show', compact('kategori', 'barangs'));
    }

    public function lainnya()
    {
        $kategori = null;
        $barangs = Barang::query()
            ->whereNull('kategori_id')
            ->paginate(4)
            ->withQueryString();

        return view('user.kategori.show', compact('barangs', 'kategori'));
    }
}
