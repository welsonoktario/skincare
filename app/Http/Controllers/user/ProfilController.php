<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Auth::user();

        return view('user.profil.index', compact('profil'));
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
        //
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

        return view('user.profil.edit', compact('user'));
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
        $user = User::query()->find($id);
        $aksi = $request->aksi;

        if ($aksi == 'password') {
            if (!Hash::check($request->currentPassword, $user->password)) {
                return redirect()->back()->withErrors('Password saat ini tidak cocok');
            }

            if ($request->password != $request->confirm) {
                return redirect()->back()->withErrors('Password baru tidak cocok');
            }

            $user->update([
                'password' => bcrypt($request->password)
            ]);

            return redirect()->route('user.profil.index');
        }

        if ($user->username != $request->username) {
            $exists = User::query()->firstWhere('username', $request->username);

            if ($exists) {
                return redirect()->back()->withErrors('Username telah digunakan');
            }
        }

        if ($user->email != $request->email) {
            $exists = User::query()->firstWhere('email', $request->email);

            if ($exists) {
                return redirect()->back()->withErrors('Email telah digunakan');
            }
        }

        if ($user->no_hp != $request->hp) {
            $exists = User::query()->firstWhere('no_hp', $request->hp);

            if ($exists) {
                return redirect()->back()->withErrors('Nomor HP telah digunakan');
            }
        }

        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->hp,
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
        //
    }

    public function password($id)
    {
        $user = User::find($id);

        return view('user.profil.password', compact('user'));
    }
}
