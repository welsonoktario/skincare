@extends('layouts.app')
@section('title', 'Skincare')
@section('content')
  @auth
    <h2 class="mb-4">Selamat Datang {{ auth()->user()->nama }}, Selamat Berbelanja</h2>
  @endauth
  @guest
    <h2 class="mb-4">Selamat datang, silahkan
      <span>
        <a class="link-primary" href="{{ route('login') }}">masuk</a>
      </span>
      atau
      <span>
        <a class="link-primary" href="{{ route('register') }}">daftar</a>
      </span>
      terlebih dahulu untuk berbelanja
    </h2>
  @endguest

  <x-user.home.grid-kategori :kategoris="$kategoris" />

  <div class="card">
    <div class="card-body">
      <x-user.home.grid-produk title="Produk Terbaru" :produks="$barangs" />
      <x-user.home.grid-produk title="Produk Terlaris" :produks="$barangs" />
      <x-user.home.grid-produk title="Produk Terlaris" :produks="$barangs" />
      <x-user.home.grid-produk title="Produk Terlaris" :produks="$barangs" />
    </div>
  </div>
@endsection
