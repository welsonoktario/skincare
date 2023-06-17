<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toko = Toko::firstWhere('id', Auth::user()->toko->id);
        $transaksis = Transaksi::where('toko_id', Auth::user()->toko->id)->get();
        return view('toko.home', compact('toko', 'transaksis'));
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

        $toko = $request->user()
            ->toko()
            ->create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'no_telepon' => $request->no_telepon,
                'kota_id' => $request->kota,
                'foto' => $path
            ]);

        if (!$toko) {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
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
