@extends('layouts.app')
@section('title', 'Pembayaran • Skincare')
@section('content')
<div class="container mx-auto bg-white p-4 rounded shadow-sm mt-md-0 text-dark-all" style="margin-top: 22%">
  <h5>Rincian Transaksi</h5>
  @foreach ($transaksis as $transaksi)
      <p class="mb-0">Total harga: @rupiah($transaksi->total_harga)</p>
      <p class="mb-0">Ongkos pengiriman: @rupiah($transaksi->ongkos_pengiriman)</p>
      <p class="fw-bold">Total: @rupiah($transaksi->total_harga + $transaksi->ongkos_pengiriman)</p>
  @endforeach

  <h5>Petunjuk Pembayaran</h5>
  <ol>
    <li>
      Datang ke <strong>ATM BCA</strong> terdekat atau menggunakan <strong>m-BCA</strong>
    </li>
    <li>
      Transfer ke rekening <strong>BCA 4720181695 a.n. Aldi Kobeng</strong>
    </li>
    <li>
      Masukkan jumlah transfer sebesar <strong>@rupiah($total)</strong>
    </li>
    <li>
      <strong>Foto atau <i>screenshot</i> resi bukti pembayaran</strong> dan lampirkan pada halaman ini
    </li>
  </ol>
</div>
@endsection
