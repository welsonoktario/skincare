<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Ekspedisi;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Throwable;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $provinsis = Provinsi::all();
        $alamat = $user->alamats()
            ->with(['kota', 'provinsi'])
            ->firstWhere('is_utama', true);
        $keranjangs = $user->keranjangsWithTokoEskpedisi()
            ->when($request->toko, function ($q) use ($request) {
                return $q->where('toko_id', $request->toko);
            })
            ->get()
            ->groupBy('toko.nama');
        $keranjangs = $keranjangs->map(function ($keranjang) {
            return [
                'barangs' => $keranjang,
                'total' => collect($keranjang)->sum(function ($barang) {
                    return $barang->pivot->sub_total;
                })
            ];
        });
        // dd($alamat);

        $total = collect($keranjangs)->sum(function ($keranjang) {
            return $keranjang['total'];
        });

        // return Response::json($keranjangs);

        return view('user.checkout.index', compact(
            'provinsis',
            'alamat',
            'keranjangs',
            'total'
        ));
    }

    /**
     * TODO:
     * 1. Kurangi stok barang
     * 2. Hapus barang di keranjang yang di checkout
     * 3. Potong saldo kalau bayar pakai saldo
     */
    public function checkout(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $ekspedisis = $request->ekspedisis;
        $ongkirs = $request->ongkirs;
        $alamat = $request->alamat;
        $pembayaran = $request->metode;
        $transaksis = [];

        $keranjangs = $user->keranjangsWithTokoEskpedisi()
            ->when($request->toko, function ($q) use ($request) {
                return $q->where('toko_id', $request->toko);
            })
            ->get()
            ->groupBy('toko.nama');

        $total = $keranjangs->sum(function ($keranjang) {
            return $keranjang->sum(function ($barang) {
                return $barang->pivot->sub_total;
            });
        });

        DB::beginTransaction();

        try {
            foreach ($keranjangs as $toko => $barangs) {
                // dd($ekspedisis[$toko]);
                $total = $barangs->sum(function ($b) {
                    return $b->pivot->sub_total;
                });
                $ongkir = $ongkirs[$toko];
                $idToko = $barangs[0]->toko_id;

                $ekspedisi = Ekspedisi::query()
                    ->firstWhere('nama', $ekspedisis[$toko])
                    ->id;

                $transaksi = Auth::user()
                    ->transaksis()
                    ->create([
                        'toko_id' => $idToko,
                        'ekspedisi_id' => $ekspedisi,
                        'alamat_id' => $alamat,
                        'total_harga' => $total,
                        'ongkos_pengiriman' => $ongkir,
                        'jenis_pembayaran' => $pembayaran,
                    ]);
                $transaksiDetails = [];

                foreach ($barangs as $barang) {
                    $transaksiDetails[] = [
                        'barang_id' => $barang->id,
                        'sub_total' => $barang->pivot->sub_total,
                        'jumlah' => $barang->pivot->jumlah
                    ];
                }

                $transaksi->transaksiDetails()->createMany($transaksiDetails);
                $transaksis[] = (int) $transaksi->id;
            }

            DB::commit();

            return Redirect::route('user.checkout.pembayaran', compact('transaksis'));
        } catch (Throwable $e) {
            DB::rollBack();

            return Redirect::back()->withException($e);
        }
    }

    public function pembayaran(Request $request)
    {
        $transaksis = Transaksi::query()
            ->whereIn('id', $request->transaksis)
            ->get();

        $total = collect($transaksis)->sum(function ($transaksi) {
            return ($transaksi->total_harga + $transaksi->ongkos_pengiriman);
        });

        return view('user.checkout.pembayaran', compact('transaksis', 'total'));
    }

    public function loadKota(Request $request)
    {
        $kotas = Kota::query()
            ->whereProvinsiId($request->provinsi)
            ->get();

        return $kotas->toJson();
    }

    public function loadAlamats()
    {
        $alamats = Auth::user()
            ->alamats()
            ->with(['kota', 'provinsi'])
            ->get();

        return view('user.checkout.alamats', compact('alamats'));
    }

    public function loadOngkir(Request $request)
    {
        $res = Http::asForm()
            ->withHeaders([
                'key' => env('RAJA_ONGKIR_API_KEY', null),
                'content-type' => 'application/x-www-form-urlencoded',
            ])
            ->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $request->origin,
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => $request->courier
            ])
            ->json();

        return $res;
    }
}
