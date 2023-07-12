<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Throwable;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $alamats = Auth::user()
            ->alamats()
            ->with(['provinsi:id,nama'])
            ->orderBy('is_utama', 'DESC')
            ->get();
        $provinsis = Provinsi::all();

        if (Route::is('user.profil.alamat.index')) {
            return view('user.alamat.index', compact('alamats', 'provinsis'));
        } elseif (Route::is('user.checkout.alamats')) {
            return view('user.checkout.alamats', compact('alamats'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('isUtama')) {
            Auth::user()->alamats()
                ->update(['is_utama' => false]);
        }

        try {
            $this->validate($request, [
                'kontak' => ['regex:/^08\d{8,11}$/'],
            ]);
        } catch (Throwable $e) {
            alert()->error('Gagal', 'Kontak penerima tidak valid');

            return Redirect::back();
        }

        $create = Auth::user()->alamats()
            ->create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'provinsi_id' => $request->provinsi,
                'kota_id' => $request->kota,
                'penerima' => $request->penerima,
                'kontak' => $request->kontak,
                'is_utama' => $request->has('isUtama') ? true : false
            ]);

        if ($create) {
            alert()->success('Sukses', 'Alamat berhasil ditambahkan');
        } else {
            alert()->error('Gagal', 'Terjadi kesalahan menambahkan alamat');
        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function show(Alamat $alamat)
    {
        $alamat->load(['kota', 'provinsi']);

        return $alamat->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            $this->validate($request, [
                'kontak' => ['regex:/^08\d{8,11}$/'],
            ]);
        } catch (Throwable $e) {
            alert()->error('Gagal', 'Kontak penerima tidak valid');

            return Redirect::back();
        }

        if ($request->has('isUtama')) {
            Auth::user()->alamats()
                ->update(['is_utama' => false]);
        }

        $update = Alamat::query()
            ->find($id)
            ->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'provinsi_id' => $request->provinsi,
                'kota_id' => $request->kota,
                'penerima' => $request->penerima,
                'kontak' => $request->kontak,
                'is_utama' => $request->has('isUtama') ? true : false
            ]);

        if ($update) {
            alert()->success('Sukses', 'Alamat berhasil diubah');
        } else {
            alert()->error('Gagal', 'Terjadi kesalahan mengubah alamat');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alamat $alamat)
    {
        $delete = $alamat->delete();

        if ($delete) {
            alert()->success('Sukses', 'Alamat berhasil dihapus');
        } else {
            alert()->error('Gagal', 'Terjadi kesalahan menghapus alamat');
        }

        return Redirect::back();
    }

    public function setUtama(Alamat $alamat)
    {
        try {
            DB::beginTransaction();

            Auth::user()->alamats()
                ->where('id', '!=', $alamat->id)
                ->update(['is_utama' => false]);
            $alamat->update(['is_utama' => true]);

            DB::commit();
            alert()->success('Sukses', 'Berhasil mengubah alamat utama');
        } catch (Throwable $e) {
            DB::rollBack();
            alert()->erorr('Gagal', 'Terjadi kesalahan mengubah alamat utama');
        }

        return Redirect()->back();
    }
}
