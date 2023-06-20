<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $kategoris = Kategori::all();

        // barang terlaris
        $terlaris = Barang::query()
            ->withCount('transaksiDetails')
            ->having('transaksi_details_count', '>', 0)
            // kalo user login dan punya toko, hanya tampilkan barang yang bukan punya toko dari user
            ->when($user && $user->toko && $user->toko->id, function ($q) use ($user) {
                return $q->where('toko_id', '!=', $user->toko->id);
            })
            ->where('status', 'diterima')
            ->orderBy('transaksi_details_count', 'desc')
            ->get()
            ->take(10);

        $terbaru = Barang::query()
            // kalo user login dan punya toko, hanya tampilkan barang yang bukan punya toko dari user
            ->when($user && $user->toko && $user->toko->id, function ($q) use ($user) {
                return $q->where('toko_id', '!=', $user->toko->id);
            })
            ->where('status', 'diterima')
            ->latest('created_at')
            ->get()
            ->take(10);

        return view('user.home', compact('kategoris', 'terlaris', 'terbaru'));
    }

    public function search(Request $request)
    {
        // ambil hasil ketikan dari ajax js
        $query = $request->get('query');

        try {
            // ambil barang yang sesuai
            $barangs = Barang::query()
                ->whereRaw('LOWER(`nama`) LIKE ?', [
                    trim(strtolower("%{$query}%"))
                ])
                ->get();

            // ambil toko yang sesuai
            $tokos = Toko::query()
                ->whereRaw('LOWER(`nama`) LIKE ?', [
                    trim(strtolower("%{$query}%"))
                ])
                ->get();

            // kembalikan hasil data berupa response
            return response()->json([
                'status' => 'ok',
                'data' => compact('barangs', 'tokos')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'gagal',
                'msg' => 'Terjadi kesalahan memuat hasil pencarian',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
