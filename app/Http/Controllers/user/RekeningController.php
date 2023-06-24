<?php

namespace App\Http\Controllers\User;

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
        $user = Auth::user();
        $rekenings = $user->rekenings;

        return view('user.rekening.index', compact('rekenings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();

        return view('user.rekening.create', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()
            ->rekenings()
            ->create([
                'bank_id' => $request->bank,
                'nomor_rekening' => $request->rekening,
                'nama_penerima' => $request->penerima
            ]);

        return redirect()->back();
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

        return view('user.rekening.edit', compact('banks', 'rekening'));
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

        $rekening->update([
            'bank_id' => $request->bank,
            'nomor_rekening' => $request->rekening,
            'nama_penerima' => $request->penerima,
        ]);

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
        Rekening::query()->find($id)->delete();

        return redirect()->back();
    }
}
