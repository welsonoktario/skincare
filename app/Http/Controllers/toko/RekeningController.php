<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekenings = Rekening::with(['bank'])
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('toko.rekening.index', compact('rekenings'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();

        return view('toko.rekening.create', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = Auth::user()
            ->rekenings()
            ->create([
                'bank_id' => $request->bank,
                'nomor_rekening' => $request->rekening,
                'nama_penerima' => $request->penerima
            ]);

        if ($store) {
            alert()->success('Sukses', 'Data rekening berhasil ditambah');
        } else {
            alert()->error('Gagal', 'Terjadi kesalahan menambah data rekening');
        }

        return redirect()->route('toko.rekening.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banks = Bank::all();
        $rekening = Rekening::query()
            ->with('bank')
            ->find($id);

        return view('toko.rekening.edit', compact('banks', 'rekening'));
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
        $rekening = Rekening::query()->find($id);

        $update = $rekening->update([
            'bank_id' => $request->bank,
            'nomor_rekening' => $request->rekening,
            'nama_penerima' => $request->penerima,
        ]);

        if ($update) {
            alert()->success('Sukses', 'Data rekening berhasil diubah');
        } else {
            alert()->error('Gagal', 'Terjadi kesalahan mengubah data rekening');
        }

        return redirect()->route('toko.rekening.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Rekening::query()->find($id)->delete();

        if ($delete) {
            alert()->success('Sukses', 'Data rekening berhasil dihapus');
        } else {
            alert()->error('Gagal', 'Terjadi kesalahan menghapus data rekening');
        }

        return redirect()->route('toko.rekening.index');
    }
}
