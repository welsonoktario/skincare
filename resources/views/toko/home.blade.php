@php
  $toko = auth()->user()->toko;
@endphp

@extends('layouts.toko')
@section('content')
  @if ($toko->status == 'pending')
    <p>Pengajuan toko anda sedang dalam peninjauan</p>
  @elseif ($toko->status == 'ditolak')
    <p>Pengajuan toko anda ditolak</p>
  @else
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-stats">
          <div class="card-stats-title">Order Statistics -

          </div>
          <div class="card-stats-items">

            <div class="card-stats-item">
              <div class="card-stats-item-label">Berhasil</div>
            </div>

            <div class="card-stats-item">
              <div class="card-stats-item-count">12</div>
              <div class="card-stats-item-label">Shipping</div>
            </div>
            <div class="card-stats-item">
              <div class="card-stats-item-count">23</div>
              <div class="card-stats-item-label">Completed</div>
            </div>

          </div>
        </div>
        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-archive"></i>
        </div>
        <div class="card-wrap">
          @foreach ($transaksis as $t)
            <div class="card-header">
              <h4>Total Orders</h4>
            </div>
            <div class="card-body">
              {{ $t->count() }}
            </div>
          @endforeach
        </div>
      </div>
    </div>
  @endif
@endsection
