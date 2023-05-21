<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function show(Barang $produk)
    {
        $produk->load([
            'toko',
            'etalase',
            'kategori',
            'fotos',
            'ulasans',
            'users' => function ($q) use ($produk) {
                return $q->firstWhere([
                    ['barang_id', $produk->id],
                    ['user_id', Auth::id()]
                ]);
            }
        ]);

        return view('user.produk.show', compact('produk'));
    }
}
