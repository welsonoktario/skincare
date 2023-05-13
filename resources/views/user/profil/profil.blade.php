@php
  $profil = auth()->user();
  $currentRoute = request()
      ->route()
      ->getName();
@endphp

@extends('layouts.app')
@section('title', 'Profil • Skincare')
@section('content')
  <div class="grid mt-md-0" style="margin-top: 22%">
    <div class="row row-cols-1 row-cols-lg-2">
      <div class="col-12 col-md-5 col-lg-3 sticky-md-top align-self-md-start" style="top: 10%">
        <div class="bg-white p-4 rounded-4 shadow-sm">
          <div class="section-profil">
            <p class="fw-bold mb-0">{{ $profil->nama }}</p>
            <hr class="form-divider">
            <div class="d-flex flex-row justify-content-between align-items-center">
              <p class="mb-0">Saldo</p>
              <div class="d-inline-flex" style="column-gap: 0.8rem">
                <p class="mb-0">@rupiah($profil->saldo)</p>
                <a href="{{ route('user.topup.index') }}" class="btn btn-sm btn-outline-primary" role="button">Topup</a>
              </div>
            </div>
          </div>
          <hr class="form-divider">
          <div class="section-menu">
            <p class="fw-bold mt-2 mb-0">Pengaturan Profil</p>
            <hr class="form-divider">
            <div class="list-group">
              <a href="{{ route('user.profil.index') }}"
                class="list-group-item list-group-item-action {{ $currentRoute == 'user.profil.index' ? 'active' : '' }}">Akun</a>
              <a href="{{ route('user.profil.alamat.index') }}"
                class="list-group-item list-group-item-action {{ $currentRoute == 'user.profil.alamat.index' ? 'active' : '' }}">Daftar
                Alamat</a>
              <a href="{{ route('user.transaksi.index') }}"
                class="list-group-item list-group-item-action {{ $currentRoute == 'user.transaksi.index' ? 'active' : '' }}">Daftar
                Transaksi</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-7 col-lg-9">
        <div class="bg-white p-4 rounded-4 shadow-sm">
          @yield('profil-content')
        </div>
      </div>
    </div>
  </div>
@endsection
