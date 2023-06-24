<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Penarikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenarikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->load('toko');
        $toko = $user->toko;
        $penarikans = $user->penarikans()
            ->with(['rekening.bank'])
            ->where('asal_penarikan', 'toko')
            ->whereHas('rekening', fn ($q) => $q->where('user_id', $user->id))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('toko.penarikan.index', compact('user', 'toko', 'penarikans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user()->load(['toko', 'rekenings.bank']);
        $toko = $user->toko;
        $rekenings = $user->rekenings;

        return view('toko.penarikan.create', compact('user', 'toko', 'rekenings'));
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
