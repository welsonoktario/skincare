@extends('layouts.app')
@section('title', 'Daftar Kategori • Skincare')
@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item">Kategori</li>
    </ol>
  </nav>

  <x-user.home.grid-kategori :kategoris="$kategoris" />
@endsection
