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

  <div class="card mt-md-0 pt-md-0" style="margin-top: 22%">
    <div class="card-body">
      <h5 class="text-">Kategori</h5>
      <div class="grid">
        <div class="row row-cols-2 row-cols-md-4 justify-content-center">
          @foreach ($kategoris as $kategori)
            <div class="col p-0">
              <a href="{{ route('user.kategori.show', $kategori->id) }}"
                class="card bg-primary card-primary-hover text-decoration-none m-1 m-md-2">
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 6rem">
                  <h6 class="text-title text-white mb-0 text-center">
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
          <x-shared.card-produk :produk="$produk" />
        </div>
      @endforeach
    </div>
  </div>

  <h5 class="text-">Produk Terlaris</h5>
  <div class="overflow-auto">
    <div class="d-flex flex-row py-2 overflow-x-auto">
      @foreach ($terlaris as $produk)
        <div class="col-10 col-md-3">
          <x-shared.card-produk :produk="$produk" />
        </div>
      @endforeach
    </div>
  </div>
@endsection
