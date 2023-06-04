@extends('layouts.toko')
@section('content')
  <div class="card w-100">
    <div class="card-body">
      <h4 class="card-title">
        <p><strong>Profil {{ $tokos->nama }}&nbsp;</p> </strong>
      </h4>
      <br>
      <div class="row">
        <p class="col-sm-2">Id User</p>
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
        <p class="col-sm-2">Saldo</p>
        <div class="col-sm-10">
          <p class="card-text">: {{ $tokos->saldo }}</p>
        </div>
  </div>
@endsection
