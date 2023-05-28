<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Etalase;
use App\Models\Toko;
use Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EtalaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etalases = Etalase::Where('toko_id',Auth::user()->toko->id)->get();
        // dd($etalase);
        return view('toko.etalase.index',compact('etalases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $etalases= Etalase::where('toko_id',Auth::user()->toko->id)->get();
        return view('toko.etalase.create',compact('etalases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $etalases = Auth::user()->toko->etalase::create([

        // ])
        $etalases = Etalase::create([
            'nama' => $request->nama_etalase,
            'toko_id' => Auth::user()->toko->id,
        ]);
        // Alert::success('Sukses');
        return redirect()->route('toko.etalase.index')->with('toast_success', 'Barang telah ditambah');
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
        $etalases= Etalase::where('toko_id',Auth::user()->toko->id)->get();
        return view('toko.etalase.edit',compact('etalases'));
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
        $etalases = Etalase::whereId($id)->firstOrFail();
        $namaEtalases = $etalases->nama;
        $etalases->delete();

        return redirect()->route('toko.etalase.index')->with('success', 'Barang dengan nama ' . $namaEtalases . ' telah dihapus');
    }
}
