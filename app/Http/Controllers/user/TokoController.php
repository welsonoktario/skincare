<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $etalase = $request->etalase;

        $toko = Toko::with(['etalases', 'barangs'])->find($id);
        $etalases = $toko->etalases;
        $barangs = $toko->barangs()
            ->where('toko_id', $id)
            ->when($etalase, fn ($q) => $q->where('etalase_id', $etalase))
            ->get();

        return view('user.toko.index', compact('toko', 'etalases', 'barangs'));
    }
}
