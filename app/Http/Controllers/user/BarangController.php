<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Toko;
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
        $noHp = str_starts_with($produk->toko->no_telepon, '+')
            ? str_replace('+', '', $produk->toko->no_telepon)
            : '62' . substr($produk->toko->no_telepon, 1);

        return view('user.produk.show', compact('produk', 'noHp'));
    }
}
