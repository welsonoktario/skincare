<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = Kategori::all();

        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $request->file('icon')->store(
            'img/kategori',
            'public'
        );

        $kategori = Kategori::create([
            'nama' => $request->nama,
            'icon' => "/storage/{$path}",
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
        $kategori = Kategori::find($id);

        return view('admin.kategori.edit', compact('kategori'));
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
        $storage = Storage::disk('public');
        $kategori = Kategori::find($id);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');

            if ($storage->exists($kategori->icon)) {
                $storage->delete($kategori->icon);
            }

            $path = $icon->store('img/kategori', 'public'); // img/kategori/fjbfoafboa.png/jpg

            $kategori->nama = $request->nama;
            $kategori->icon = "/storage/$path"; // img/kategori/fjbfoafboa.png/jpg
            $kategori->save();
        } else {
            $kategori->nama = $request->nama;
            $kategori->save();
        }

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
        Kategori::query()
            ->find($id)
            ->delete();

        return redirect()->back();
    }
}
