<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Throwable;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Auth::user()
            ->wishlists()
            ->get();

        return view('user.wishlist.index', compact('wishlists'));
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
        $wishlists = Auth::user()->wishlists();

        try {
            $wishlists->attach([$request->barang]);
            alert()->success('Sukses', 'Barang berhasil ditambahkan ke wishlist');
        } catch (Throwable $e) {
            alert()->error('Gagal', 'Terjadi kesalahan menambah barang ke wishist');
        }

        return Redirect::back();
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
        $wishlists = Auth::user()->wishlists();

        try {
            $wishlists->detach($id);
            alert()->success('Sukses', 'Barang berhasil dihapus dari wishlist');
        } catch (Throwable $e) {
            alert()->error('Gagal', 'Terjadi kesalahan menghapus barang dari wishist');
        }

        return Redirect::back();
    }
}
