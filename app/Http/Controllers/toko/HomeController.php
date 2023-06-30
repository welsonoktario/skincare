<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Models\Toko;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $toko = Toko::query()->firstWhere('id', Auth::user()->toko->id);

        // barang toko yang paling laris, berdasarkan jumlah transaksi_details terbanyak
        // yang status transaksi nya 'selesai' atau status pengembalian nya 'ditolak'
        $terlaris = $toko->barangs()
            ->withCount('transaksiDetails as jumlah_transaksi')
            ->whereHas('transaksiDetails.transaksi', function (Builder $q) {
                return $q->where('status', 'selesai');
            })
            ->orWhereHas('transaksiDetails.transaksi.pengembalian', function (Builder $q) {
                return $q->where('status', 'ditolak');
            })
            ->having('jumlah_transaksi', '>', 0)
            ->limit(5)
            ->get();

        // pendapatan sebulan terakhir
        $period = collect(CarbonPeriod::create(now()->subdays(30), now()->subday())->toArray());
        $pendapatan = $toko->transaksis()
            ->select([
                DB::raw('SUM(total_harga) as total'),
                DB::raw('COUNT(id) as count'),
                DB::raw("DATE(created_at) as date"),
                DB::raw('EXTRACT(DAY FROM created_at) as day'),
                DB::raw('EXTRACT(MONTH FROM created_at) as month'),
            ])
            ->where('status', 'selesai')
            ->whereBetween('created_at', [now()->subdays(30), now()->subday()])
            ->groupBy(['date', 'day', 'month'])
            ->get();

        // Iterate over the period
        $period = $period->map(function ($date) use ($pendapatan) {
            $d = $date->copy()->toDateString('Y-m-d');
            $date = $pendapatan->firstWhere('date', $d) ?: collect([
                'total' => 0,
                'date' => $d,
                'count' => 0,
                'day' => $date->copy()->day,
                'month' => $date->copy()->month
            ]);

            return $date;
        });

        $pendapatan = [
            'labels' => [],
            'data' => [],
            'total' => 0
        ];
        $totalTransaksi = [
            'labels' => [],
            'data' => [],
            'total' => 0
        ];
        $pendapatan['total'] = $period->sum('total');
        $totalTransaksi['total'] = $period->sum('count');
        $pendapatan['labels'] = $period->map(function ($p) {
            return $p['date'];
        });
        $totalTransaksi['labels'] = $period->map(function ($p) {
            return $p['date'];
        });
        $pendapatan['data'] = $period->map(function ($p) {
            return (int) $p['total'];
        });
        $totalTransaksi['data'] = $period->map(function ($p) {
            return (int) $p['count'];
        });


        return view('toko.home', compact('toko', 'terlaris', 'pendapatan', 'totalTransaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsis = Provinsi::with('kotas:id,nama')->get();

        return view('toko.create', compact('provinsis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $foto = $request->file('foto');
        $path = $foto->store('img/toko', 'public');

        DB::beginTransaction();
        try {
            $toko = $request->user()
                ->toko()
                ->create([
                    'nama' => $request->nama,
                    'deskripsi' => $request->deskripsi,
                    'no_telepon' => $request->no_telepon,
                    'kota_id' => $request->kota,
                    'foto' => $path
                ]);

            DB::commit();

            if (!$toko) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            alert()->success('Sukses', 'Pengajuan toko berhasil ditambahkan');
        } catch(Throwable $e) {
            alert()->error('Gagal', 'Terjadi kesalahan menyimpan data pengajuan toko');
        }

        return redirect()->route('toko.hometoko');
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
        //
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
        //
    }

    public function loadKota(int $provinsi)
    {
        $kotas = Kota::query()
            ->where('provinsi_id', $provinsi)
            ->get();

        return response()->json(compact('kotas'));
    }
}
