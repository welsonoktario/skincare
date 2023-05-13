@php
  $tipes = [['tipe' => 'pending', 'label' => 'Pending'], ['tipe' => 'diproses', 'label' => 'Diproses'], ['tipe' => 'dikirim', 'label' => 'Dikirim'], ['tipe' => 'ulas', 'label' => 'Menunggu Ulasan'], ['tipe' => 'selesai', 'label' => 'Selesai'], ['tipe' => 'batal', 'label' => 'Dibatalkan']];
  $currentTipe = request()->get('tipe') ?: 'semua';
@endphp

@extends('user.profil.profil')
@section('title', 'Daftar Transaksi • Skincare')
@section('profil-content')
  <h6 class="mt-2 mx-0 mb-0 text-dark">Daftar Transaksi</h6>

  <ul class="nav nav-pills nav-fill mt-4">
    @foreach ($tipes as $tipe)
      <li class="nav-item">
        <a class="nav-link {{ $currentTipe == $tipe['tipe'] ? 'active' : '' }}"
          href="?tipe={{ $tipe['tipe'] }}">{{ $tipe['label'] }}</a>
      </li>
    @endforeach
  </ul>
  <div class="mt-4 text-dark list-transaksi">
    @foreach ($transaksis as $transaksi)
      @php
        $toko = $transaksi->toko;
        $transaksiDetails = $transaksi->transaksiDetails;
        $barang = $transaksiDetails[0]->barang;
      @endphp

      <div class="card rounded-2 shadow-sm" style="border: 1px solid var(--primary);">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex flex-row align-items-center" style="column-gap: 1rem">
                <a class="fw-bold link-secondary text-decoration-none" href="#">{{ $toko->nama }}</a>
                @switch($transaksi->status)
                  @case('diproses')
                    <label class="badge badge-pill badge-warning" style="font-size: 0.6rem">Diproses</label>
                  @break

                  @case('dikirim')
                    <label class="badge badge-pill badge-primary" style="font-size: 0.6rem">Dikirim</label>
                  @break

                  @case('ulas')
                    <label class="badge badge-pill badge-info" style="font-size: 0.6rem">Menunggu Ulasan</label>
                  @break

                  @case('selesai')
                    <label class="badge badge-pill badge-success" style="font-size: 0.6rem">Selesai</label>
                  @break

                  @case('batal')
                    <label class="badge badge-pill badge-danger" style="font-size: 0.6rem">Dibatalkan</label>
                  @break

                  @default
                    <label class="badge badge-pill badge-secondary" style="font-size: 0.6rem">Menunggu Pembayaran</label>
                @endswitch
              </div>
              <div class="d-flex flex-row mt-2" style="column-gap: 0.8rem">
                <img class="w-auto rounded" src="{{ $barang->placeholder }}" alt="{{ $barang->nama }}" height="72px">
                <div class="d-flex flex-column">
                  <p>{{ $barang->nama }}</p>
                </div>
              </div>
            </div>
            <div class="col-3 d-flex flex-row align-items-center" style="column-gap: 1rem">
              <div class="vr"></div>
              <div>
                <p class="mb-0 text-small">Total Transaksi</p>
                <h6 class="mb-0">@rupiah($transaksi->total_harga)</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
