@extends('layouts.app')
@section('title', 'Daftar Kategori • Skincare')
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
@endsection
