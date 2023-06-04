<?php

namespace App\Http\Controllers\toko;

use App\Http\Controllers\Controller;
use App\Models\Penarikan;
use App\Models\Rekening;
use App\Models\Toko;
use Auth;
use Illuminate\Http\Request;

class PenarikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penarikans = Penarikan::where('asal_penarikan','toko')->where('user_id', Auth::user()->id)->get();
        $tokos = Toko::firstWhere('id', Auth::user()->toko->id);
        $rekenings = Rekening::with(['bank'])->where('user_id', Auth::user()->id)->get();
        return view('toko.penarikan.index',compact('penarikans','tokos','rekenings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penarikans = Penarikan::where('user_id', Auth::user()->id)->get();
        $rekenings = Rekening::with(['bank'])->where('user_id', Auth::user()->id)->get();
        return view('toko.penarikan.create',compact('penarikans','rekenings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $penarikans = Penarikan::create([
            'nominal' => $request->nominal,
            'asal_penarikan' => 'toko',
            'status' => 'pending',
            'user_id' => Auth::id(),
            'nomor_rekening' => $request->nomor_rekening
        ]);
        // Alert::success('Sukses');
        return redirect()->route('toko.penarikan.index')->with('toast_success', 'Penarikan telah ditambah');
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
