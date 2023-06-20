<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
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
        $userId = Auth::user()->id;
        $provinsis = Provinsi::all();
        // $alamat = $user->alamats()
        //     ->with(['kota', 'provinsi'])
        //     ->firstWhere('is_utama', true);
        $alamat = Alamat::whereUserId($userId)
            ->with(['kota', 'provinsi'])
            ->get();
        // return dd($alamat);
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
        // dd($keranjangs2);

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

    public function getPayment(Request $request)
    {
        // count payment gateway in index
        $user = Auth::user();
        $total = $request->total;

        // PAYMENT
        $getName = $user->nama;
        $getPhone = $user->no_hp;
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-yUxga--v_4EQ_EKe8TWMMmbZ';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // $ongkir = $request->ongkirs
        // $grand_total =  $total + $ongkirs; sementara belum ada ongkos kirim yang ter-generate
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $total, // ganti jadi $grand_total kalau sudah ada ongkos kirim
            ],
            'customer_details' => [
                'first_name' => $getName,
                'phone' => $getPhone
            ],
        ];
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json(['snapToken' => $snapToken]);
    }

    public function payment_post(Request $request)
    {
        $user = Auth::user();
        $ekspedisis = $request->ekspedisis;
        $ongkirs = $request->ongkirs;
        $alamat = $request->alamat;
        $metode = $request->metode;
        $date = now();
        $transaksis = [];

        $keranjangs = $user->keranjangsWithTokoEskpedisi()
            ->when($request->toko, function ($q) use ($request) {
                return $q->where('toko_id', $request->toko);
            })
            ->whereIn('id', $request->barangs)
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
                $total = $barangs->sum(function ($b) {
                    return $b->pivot->sub_total;
                });
                $ongkir = $ongkirs[$toko];
                $idToko = $barangs[0]->toko_id;

                if ($metode == 'transfer') {
                    // Bayar pake midtrans
                    $json = json_decode($request->get('json'));
                    $pembayaran = $json->payment_type;
                    $payment_code = isset($json->payment_code) ? $json->payment_code : null;
                    $status = $json->transaction_status == 'settlement' ? 'menunggu konfirmasi' : 'menunggu pembayaran';

                    $transaksi = Auth::user()
                        ->transaksis()
                        ->create([
                            'toko_id' => $idToko,
                            'ekspedisi_id' => $ekspedisis,
                            'alamat_id' => $alamat,
                            'total_harga' => $total,
                            'ongkos_pengiriman' => $ongkir,
                            'jenis_pembayaran' => $pembayaran,
                            'kode_pembayaran' => $payment_code,
                            'status' => $status,
                            'created_at' => $date
                        ]);
                } elseif ($metode == 'saldo') {
                    $transaksi = Auth::user()
                        ->transaksis()
                        ->create([
                            'toko_id' => $idToko,
                            'ekspedisi_id' => $ekspedisis,
                            'alamat_id' => $alamat,
                            'date' => $date,
                            'total_harga' => $total,
                            'ongkos_pengiriman' => $ongkir,
                            'jenis_pembayaran' => 'saldo',
                            'kode_pembayaran' => $date->format('Ymdhms'),
                            'status' => 'menunggu konfirmasi'
                        ]);
                }

                $transaksiDetails = [];

                foreach ($barangs as $barang) {
                    $transaksiDetails[] = [
                        'barang_id' => $barang->id,
                        'sub_total' => $barang->pivot->sub_total,
                        'jumlah' => $barang->pivot->jumlah
                    ];

                    $barang->update([
                        'stok' => $barang->stok - $barang->pivot->jumlah
                    ]);
                }

                if ($metode == 'saldo') {
                    $user->update([
                        'saldo' => $user->saldo - ($total + $ongkir)
                    ]);
                }

                $transaksi->transaksiDetails()->createMany($transaksiDetails);
                $transaksis[] = (int) $transaksi->id;

                $user->keranjangs()->detach($request->barangs);
            }

            DB::commit();

            if ($transaksi->status == 'menunggu pembayaran') {
                return Redirect::route('user.transaksi.index', ['tipe' => 'pembayaran']);
            } elseif ($transaksi->status == 'menunggu konfirmasi') {
                return Redirect::route('user.transaksi.index', ['tipe' => 'konfirmasi']);
            } else {
                return Redirect::route('user.transaksi.index');
            }
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
