@extends('layouts.app')
@section('title', 'Daftar Kategori • Skincareku')
@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item">Kategori</li>
    </ol>
  </nav>

  <h5 class="mt-4">Kategori</h5>

  <div class="row row-cols-2 row-cols-md-4">
    @foreach ($kategoris as $kategori)
      <div class="col p-0">
        <a href="{{ route('user.kategori.show', $kategori->id) }}"
          class="card text-bg-light text-decoration-none m-1 m-md-2">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <img src="{{ "/storage/{$kategori->icon}" }}" alt="{{ $kategori->nama }}" height="36">
            <h6 class="text-title mt-4 mb-0 text-center">
              {{ $kategori->nama }}
            </h6>
          </div>
        </a>
      </div>
    @endforeach
    <div class="col p-0">
      <a href="{{ route('user.kategori.lainnya') }}"
        class="card text-bg-light text-decoration-none m-1 m-md-2">
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
          <img src="{{ "/img/placeholder.jpeg" }}" alt="Lainnya" height="36">
          <h6 class="text-title mt-4 mb-0 text-center">
            Lainnya
          </h6>
        </div>
      </a>
    </div>
  </div>
@endsection
