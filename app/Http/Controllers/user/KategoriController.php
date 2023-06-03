<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();

        return view('user.kategori.index', compact('kategoris'));
    }

    public function show(Kategori $kategori)
    {
        $barangs = $kategori
            ->barangs()
            ->paginate(10)
            ->withQueryString();

        return view('user.kategori.show', compact('kategori', 'barangs'));
    }
}
