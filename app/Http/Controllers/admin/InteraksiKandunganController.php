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
            ->selectRaw('k1.id k1_id, k1.nama kandungan_satu, k2.id k2_id, k2.nama kandungan_dua, ik.jenis_interaksi jenis, ik.deskripsi_interaksi deskripsi, ik.sumber sumber')
            ->join('kandungans k1', 'k1.id', '=', 'ik.kandungan_satu_id')
            ->join('kandungans k2', 'k2.id', '=', 'ik.kandungan_dua_id')
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

        return view('admin.interaksi-kandungan.index', compact('kandungans'));
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
    public function edit(Request $request)
    {
        $kandungans = Kandungan::all();
        $k1 = $request->k1;
        $k2 = $request->k2;

        $interaksis = DB::table('interaksi_kandungans', 'ik')
            ->selectRaw('k1.id k1_id, k1.nama kandungan_satu, k2.id k2_id, k2.nama kandungan_dua, ik.jenis_interaksi jenis, ik.deskripsi_interaksi deskripsi, ik.sumber sumber')
            ->join('kandungans k1', 'k1.id', '=', 'ik.kandungan_satu_id')
            ->join('kandungans k2', 'k2.id', '=', 'ik.kandungan_dua_id')
            ->whereRaw('k1.id = ? AND k2.id = ?', [$k1, $k2])
            ->first();

        return view('admin.interaksi-kandungan.edit', compact('interaksi', 'kandungans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $interaksis = DB::table('interaksi_kandungans', 'ik')
            ->selectRaw('k1.id k1_id, k1.nama kandungan_satu, k2.id k2_id, k2.nama kandungan_dua, ik.jenis_interaksi jenis, ik.deskripsi_interaksi deskripsi, ik.sumber sumber')
            ->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
