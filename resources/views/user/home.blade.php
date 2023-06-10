@extends('layouts.app')
@section('title', 'Skincare')
@section('content')
  @auth
    <p class="mb-4">Selamat Datang <span class="fw-bold">{{ auth()->user()->nama }}</span>, Selamat Berbelanja</p>
  @endauth
  @guest
    <p class="mb-4">Selamat datang, silahkan
      <span>
        <a class="link-primary" href="{{ route('login') }}">masuk</a>
      </span>
      atau
      <span>
        <a class="link-primary" href="{{ route('register') }}">daftar</a>
      </span>
      terlebih dahulu untuk berbelanja
    </p>
  @endguest

  <div class="card mt-md-0 pt-md-0" style="margin-top: 22%">
    <div class="card-body">
      <h5 class="text-">Kategori</h5>
      <div class="grid">
        <div class="row row-cols-2 row-cols-md-4 justify-content-center">
          @foreach ($kategoris as $kategori)
            <div class="col p-0">
              <a href="{{ route('user.kategori.show', $kategori->id) }}"
                class="card bg-primary card-primary-hover text-decoration-none m-1 m-md-2">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                  <img src="{{ $kategori->icon }}" alt="{{ $kategori->nama }}" height="36">
                  <h6 class="text-title text-white mt-4 mb-0 text-center">
                    {{ $kategori->nama }}
                  </h6>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <h5 class="text-">Produk Terbaru</h5>
  <div class="overflow-auto">
    <div class="d-flex flex-row py-2 overflow-x-auto">
      @foreach ($terbaru as $produk)
        <div class="col-10 col-md-3">
          <x-card-produk :produk="$produk" />
        </div>
      @endforeach
    </div>
  </div>

  <h5 class="text-">Produk Terlaris</h5>
  <div class="overflow-auto">
    <div class="d-flex flex-row py-2 overflow-x-auto">
      @foreach ($terlaris as $produk)
        <div class="col-10 col-md-3">
          <x-card-produk :produk="$produk" />
        </div>
      @endforeach
    </div>
  </div>
@endsection
