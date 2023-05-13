@extends('layouts.toko')
@section('content')
  @if ($toko)
    <p> Nama Toko : {{ $toko->nama }}</p>
    <p> Alamat Toko : {{ $toko->alamat }}</p>
    <p> Deskripsi Toko : {{ $toko->deskripsi }}</p>
    <p> Saldo : {{ $toko->saldo }}</p>
  @endif
@endsection
