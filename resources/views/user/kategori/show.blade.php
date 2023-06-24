@extends('layouts.app')
@section('title', $kategori ? $kategori->nama : 'Lainnya' . ' • Skincareku')
@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('user.kategori.index') }}">Kategori</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $kategori ? $kategori->nama : 'Lainnya' }}</li>
    </ol>
  </nav>

  <h5 class="mt-4">Kategori {{ $kategori ? $kategori->nama : 'Lainnya' }}</h5>

  <div class="row row-cols-2 row-cols-md-4">
    @foreach ($barangs as $barang)
      <x-card-produk :produk="$barang" />
    @endforeach
  </div>

  <div class="text-right">
    {{ $barangs->links() }}
  </div>
@endsection
