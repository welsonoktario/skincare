@extends('layouts.app')
@section('title', "{$kategori->nama} • Skincare")
@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('user.kategori.index') }}">Kategori</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $kategori->nama }}</li>
    </ol>
  </nav>

  <div class="row row-cols-2 row-cols-md-4">
    @foreach ($barangs as $barang)
      <div class="p-2">
        <div class="card">
          <x-shared.card-produk :produk="$barang" />
        </div>
      </div>
    @endforeach
  </div>

  {{ $barangs->links() }}
@endsection
