<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function show(Barang $produk)
    {
        $produk->load([
            'toko',
            'etalase',
            'kategori',
            'fotos',
            'ulasans'
        ]);

        return view('user.produk.show', compact('produk'));
    }
}
