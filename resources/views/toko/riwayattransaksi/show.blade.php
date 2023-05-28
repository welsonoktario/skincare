{{-- @extends('toko.app')

@section('content')
  <div class="card w-100 mt-4">
    <div class="card-header">
      <h2 class="card-title">Detail Riwayat Transaksi</h2>
    </div>
    <div class="card-body container-fluid">
      <div class="container-fluid mx-auto h5">
        <div class="row justify-content-center">
          <div class="col-5 col-md-2 pe-1 text-end">Nama: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $riwayattransaksi->total_harga }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Alamat: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $riwayattransaksi->jenis_pembayaran }}</div>
        </div>
        {{-- <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">No HP: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">{{ $riwayattransaksi->user->no_hp }}</div>
        </div>
        <div class="row justify-content-center mt-2">
          <div class="col-5 col-md-2 pe-1 text-end">Total: </div>
          <div class="col-7 col-md-4 ps-1 fw-bold">@rupiah($riwayattransaksi->total_harga)</div>
        </div> --}}
        <div class="modal-header">
          <h5 class="modal-title">Detail Riwayat</h5>
        </div>
        <div class="modal-body">
          <h5></h5>
          <div class="mx-2 mb-3">
            <div class="row">
              <dt class="col-4">Nama</dt>
              <dd class="col-8">{{ $riwayattransaksi->total_harga }}</dd>
            </div>
          </div>
          <div class="mx-2 mb-3">
            <div class="row">
              <dt class="col-4">Email</dt>
              <dd class="col-8">{{ $riwayattransaksi->jenis_pembayaran }}</dd>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
        </div>

