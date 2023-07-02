<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penarikan;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenarikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jenis = $request->jenis;
        $penarikans = Penarikan::query()
            ->with(['rekeningWithTrashed.user.toko', 'rekeningWithTrashed.bank'])
            ->where('status', 'pending')
            ->when($request->jenis, function ($q) use ($jenis) {
                return $q->where('asal_penarikan', $jenis);
            })
            ->get();

        return view('admin.penarikan.index', compact('penarikans', 'jenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $jenis = $request->jenis;
        $aksi = $request->aksi;
        $status = ['diterima', 'ditolak'];
        $penarikan = Penarikan::query()->with(['rekeningWithTrashed'])->find($id);

        DB::beginTransaction();

        try {
            if (in_array($aksi, $status)) {
                $penarikan->update(['status' => $aksi]);

                if ($aksi == 'ditolak') {
                    if ($jenis == 'user') {
                        $user = User::query()->find($penarikan->rekeningWithTrashed->user_id);
                        $user->update(['saldo' => $user->saldo + $penarikan->nominal]);
                    } elseif ($jenis == 'toko') {
                        $toko = Toko::query()->firstWhere('user_id', $penarikan->rekeningWithTrashed->user_id);
                        $toko->update(['saldo' => $toko->saldo + $penarikan->nominal]);
                    }
                    alert()->success('Sukses', 'Penarikan berhasil ditolak');
                } elseif($aksi == 'diterima') {
                    alert()->success('Sukses', 'Penarikan berhasil diproses');
                }

                DB::commit();
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            alert()->error('Gagal', 'Terjadi kesalahan memproses penarikan');
        }

        return redirect()->back();
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
