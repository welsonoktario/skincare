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

  <h5 class="mt-4">Kategori {{ $kategori->nama }}</h5>

  <div class="row row-cols-2 row-cols-md-4">
    @foreach ($barangs as $barang)
      <x-card-produk :produk="$barang" />
    @endforeach
  </div>

  <div class="text-right">
    {{ $barangs->links() }}
  </div>
@endsection
