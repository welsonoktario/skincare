<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Penarikan;
use App\Models\Rekening;
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
        $user = Auth::user();
        $penarikans = Penarikan::query()
            ->with(['rekeningWithTrashed.bank'])
            ->whereHas('rekeningWithTrashed', fn ($q) => $q->where('user_id', $user->id))
            ->where('asal_penarikan', 'user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.penarikan.index', compact('user', 'penarikans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $rekenings = $user->rekenings;

        return view('user.penarikan.create', compact('user', 'rekenings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->penarikans()
            ->create([
                'rekening_id' => $request->rekening,
                'nominal' => $request->nominal,
                'asal_penarikan' => 'user'
            ]);
        $user->update([
            'saldo' => $user->saldo - $request->nominal
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
    public function edit($id)
    {
        $user = Auth::user();
        $rekenings = $user->rekenings;
        $penarikan = Penarikan::query()
            ->with('rekening.bank')
            ->find($id);

        if ($penarikan->status == 'pending') {
            return view('user.penarikan.edit', compact('rekenings', 'penarikan'));
        } else {
            return 'diterima';
        }
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
        Rekening::query()
            ->find($id)
            ->update([
                'rekening_id' => $request->rekening,
                'nominal' => $request->nominal,
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
        Penarikan::query()->destroy($id);

        return redirect()->back();
    }
}
