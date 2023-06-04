@extends('layouts.toko')
@section('content')
  <div class="card w-100">
    <div class="card-body">
      <h4 class="card-title">
        <p><strong>Profil {{ $tokos->nama }}&nbsp;</p> </strong>
      </h4>
      <br>
      <div class="row">
        <p class="col-sm-2">Id Toko</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ $tokos->id }}</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Nama</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ $tokos->nama }}</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Deskripsi</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ $tokos->deskripsi }}</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Alamat</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ $tokos->alamat }}</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Nomor Telepon</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ $tokos->no_telepon }}</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Tanggal Dibuat Toko</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ \Carbon\Carbon::parse($tokos->created_at)->format('d M Y H:i:s') }}</p>
        </div>
      </div>
      <div class="row">
        <p class="col-sm-2">Saldo</p>
        <div class="d-inline-flex col-sm-5" style="column-gap: 0.8rem">
          <p class="card-text">: {{ $tokos->saldo }}</p>
          <a href="{{ route('toko.penarikan.index') }}" class="btn btn-sm btn-outline-primary" role="button">Tarik Saldo</a>
        </div>
  </div>
@endsection
