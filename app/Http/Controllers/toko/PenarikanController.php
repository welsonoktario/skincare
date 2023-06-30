<?php

namespace App\Http\Controllers\Toko;

use App\Http\Controllers\Controller;
use App\Models\Penarikan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

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
        $penarikans = Penarikan::query()
            ->with(['rekeningWithTrashed.bank'])
            ->whereHas('rekeningWithTrashed', fn ($q) => $q->where('user_id', $user->id))
            ->where('asal_penarikan', 'toko')
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
        $user = User::query()->find(Auth::id());
        $toko = $user->toko;

        DB::beginTransaction();
        try {
            $user->penarikans()
                ->create([
                    'rekening_id' => $request->rekening,
                    'nominal' => $request->nominal,
                    'asal_penarikan' => 'toko'
                ]);
            $user->toko()->update([
                'saldo' => $toko->saldo - $request->nominal
            ]);

            DB::commit();
            alert()->success('Sukses', 'Data penarikan berhasil ditambahkan');
        } catch (Throwable $e) {
            DB::rollBack();
            alert()->error('Gagal', 'Terjadi kesalahan menambah penarikan');
        }

        return redirect()->route('toko.penarikan.index');
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
