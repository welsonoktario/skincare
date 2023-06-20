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

  <h5 class="mt-4">Kategori</h5>
  <ul class="list-group list-group-horizontal w-100 overflow-x-auto">
    @foreach ($kategoris as $kategori)
      <li style="min-width: 25%">
        <a href="{{ route('user.kategori.show', $kategori->id) }}"
          class="card text-bg-light text-decoration-none m-1 m-md-2">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <img src="{{ "/storage/{$kategori->icon}" }}" alt="{{ $kategori->nama }}" height="36">
            <h6 class="text-title mt-4 mb-0 text-center">
              {{ $kategori->nama }}
            </h6>
          </div>
        </a>
      </li>
    @endforeach
    <li style="min-width: 25%">
      <a href="{{ route('user.kategori.lainnya') }}"
        class="card text-bg-light text-decoration-none m-1 m-md-2">
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
          <img src="{{ "/img/placeholder.jpeg" }}" alt="Lainnya" height="36">
          <h6 class="text-title mt-4 mb-0 text-center">
            Lainnya
          </h6>
        </div>
      </a>
    </li>
  </ul>

  <h5 class="mt-4">Produk Terbaru</h5>
  <div class="overflow-auto">
    <div class="d-flex flex-row overflow-x-auto">
      @foreach ($terbaru as $produk)
        <div class="col-10 col-md-3">
          <x-card-produk :produk="$produk" />
        </div>
      @endforeach
    </div>
  </div>

  <h5 class="mt-4">Produk Terlaris</h5>
  <div class="overflow-auto">
    <div class="d-flex flex-row overflow-x-auto">
      @foreach ($terlaris as $produk)
        <div class="col-10 col-md-3">
          <x-card-produk :produk="$produk" />
        </div>
      @endforeach
    </div>
  </div>
@endsection
