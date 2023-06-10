<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kandungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InteraksiKandunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interaksis = DB::table('interaksi_kandungans', 'ik')
            ->selectRaw('k1.id AS k1_id, k1.nama AS kandungan_satu, k2.id AS k2_id, k2.nama AS kandungan_dua, ik.jenis_interaksi AS jenis, ik.deskripsi_interaksi AS deskripsi, ik.sumber AS sumber')
            ->join('kandungans AS k1', 'k1.id', '=', 'ik.kandungan_satu_id')
            ->join('kandungans AS k2', 'k2.id', '=', 'ik.kandungan_dua_id')
            ->get();

        return view('admin.interaksi-kandungan.index', compact('interaksis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kandungans = Kandungan::all();

        return view('admin.interaksi-kandungan.create', compact('kandungans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('interaksi_kandungans')
            ->insert([
                'kandungan_satu_id' => $request->k1,
                'kandungan_dua_id' => $request->k2,
                'jenis_interaksi' => $request->jenis,
                'deskripsi_interaksi' => $request->deskripsi,
                'sumber' => $request->sumber,
            ]);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $k1
     * @param  int  $k2
     * @return \Illuminate\Http\Response
     */
    public function edit($k1, $k2)
    {
        $kandungans = Kandungan::all();

        $interaksi = DB::table('interaksi_kandungans', 'ik')
            ->selectRaw('k1.id AS k1_id, k1.nama AS kandungan_satu, k2.id AS k2_id, k2.nama AS kandungan_dua, ik.jenis_interaksi AS jenis, ik.deskripsi_interaksi AS deskripsi, ik.sumber AS sumber')
            ->join('kandungans AS k1', 'k1.id', '=', 'ik.kandungan_satu_id')
            ->join('kandungans AS k2', 'k2.id', '=', 'ik.kandungan_dua_id')
            ->whereRaw('k1.id = ? AND k2.id = ?', [$k1, $k2])
            ->first();

        return view('admin.interaksi-kandungan.edit', compact('interaksi', 'kandungans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $k1
     * @param  int  $k2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $k1, $k2)
    {
        $query = DB::table('interaksi_kandungans')
            ->whereRaw('kandungan_satu_id = ? AND kandungan_dua_id = ?', [$k1, $k2])
            ->limit(1)
            ->update([
                'kandungan_satu_id' => $k1,
                'kandungan_dua_id' => $k2,
                'jenis_interaksi' => $request->jenis,
                'deskripsi_interaksi' => $request->deskripsi,
                'sumber' => $request->sumber
            ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $k1
     * @param  int  $k2
     * @return \Illuminate\Http\Response
     */
    public function destroy($k1, $k2)
    {
        DB::table('interaksi_kandungans')
            ->where([
                ['kandungan_satu_id', $k1],
                ['kandungan_dua_id', $k2],
            ])
            ->delete();

        return redirect()->back();
    }
}
