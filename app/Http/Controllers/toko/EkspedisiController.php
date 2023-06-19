<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Ekspedisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EkspedisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toko = Auth::user()->toko;
        $ekspedisis = Ekspedisi::all();
        $tokoEkspedisis = $toko->ekspedisis;

        return view('toko.ekspedisi.index', compact('ekspedisis', 'tokoEkspedisis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $toko = Auth::user()->toko;
        $ekspedisis = $request->ekspedisis;

        $toko->ekspedisis()->sync($ekspedisis);

        return redirect()->back();
    }
}
