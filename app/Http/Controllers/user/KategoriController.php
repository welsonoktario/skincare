<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use DB;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $kategori = Kategori::query()
                ->find($id);

        $barangs = $kategori->barangs()
            ->when($user && $user->toko && $user->toko->id, function ($q) use ($user) {
                return $q->where('toko_id', '!=', $user->toko->id);
            })->where('status', 'diterima')
            ->paginate(8)
            ->withQueryString();

        return view('user.kategori.show', compact('kategori', 'barangs'));
    }

    public function lainnya()
    {
        $user = Auth::user();
        $kategori = null;
        $barangs = Barang::query()
            ->whereNull('kategori_id')
            ->when($user && $user->toko && $user->toko->id, function ($q) use ($user) {
                return $q->where('toko_id', '!=', $user->toko->id);
            })->where('status', 'diterima')
            ->paginate(8)
            ->withQueryString();

        return view('user.kategori.show', compact('barangs', 'kategori'));
    }
}
