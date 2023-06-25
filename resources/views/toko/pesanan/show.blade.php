@php
  $alamat = $transaksi->alamat;
@endphp

<div class="modal-header">
  <h5 class="modal-title">Detail Transaksi</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalDetail" aria-label="Close"></button>
</div>

<div class="modal-body text-dark">
  <div class="row justify-content-between">
    <div class="col-4">
      <p class="mb-0 text-primary">Total Transaksi</p>
      <h6 class="mb-0 fw-semibold">
        @rupiah($transaksi->total_harga + $transaksi->ongkos_pengiriman)
      </h6>
    </div>
    <div class="col-4 d-flex flex-column align-items-center">
      <div>
        <p class="mb-0 text-primary w-auto">Ekspedisi</p>
        <h6 class="mb-0 fw-semibold text-uppercase w-auto">
          {{ $transaksi->ekspedisi->nama }}
        </h6>
      </div>
    </div>
    <div class="col-4">
      <p class="mb-0 text-primary">Waktu Transaksi</p>
      <h6 class="mb-0 fw-semibold">
        {{ $transaksi->created_at->format('d M Y') }}
      </h6>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-6">
      <h6 class="mt-4 text-primary">Rincian Pengiriman</h6>
      <p class="mb-0 text-small">{{ $alamat->penerima }}</p>
      <p class="mb-0 text-small">{{ "{$alamat->alamat}, {$alamat->kota->nama}, {$alamat->kota->provinsi->nama}" }}</p>
      <p class="mb-0 text-small">{{ $alamat->kontak }}</p>
    </div>
    <div class="col-6">
      <h6 class="mt-4 text-primary">Metode Pembayaran</h6>
      <p class="mb-0">
        @if ($transaksi->jenis_pembayaran == 'bank_transfer' || $transaksi->jenis_pembayaran == 'echannel')
          Transfer Bank
        @else
          Saldo
        @endif
      </p>
    </div>
  </div>

  <h6 class="mt-4 text-primary">Rincian Pesanan</h6>
  <div class="row mt-3 mx-0">
    @foreach ($transaksi->transaksiDetails as $td)
      <div class="col-8 px-0 fw-semibold text-truncate">
        {{ $td->barang->nama }}
      </div>
      <div class="col-1 px-0"></div>
      <div class="col-3 px-0 d-flex flex-column align-items-end">
        <p class="mb-0">&times;{{ $td->jumlah }}</p>
        <p class="mb-0 fw-semibold">@rupiah($td->sub_total)</p>
      </div>
    @endforeach
    <hr class="col-12 mt-2">

    <div class="col-8 px-0 fw-semibold">
      Subtotal seluruh Produk
    </div>
    <div class="col-1 px-0"></div>
    <div class="col-3 px-0 text-end fw-semibold">
      @rupiah($transaksi->total_harga)
    </div>

    <div class="col-8 px-0">
      Ongkos Pengiriman
    </div>
    <div class="col-1 px-0"></div>
    <div class="col-3 px-0 text-end">
      @rupiah($transaksi->ongkos_pengiriman)
    </div>

    <div class="mt-1 col-8 px-0 fs-6 fw-semibold text-primary">
      Total Pembayaran
    </div>
    <div class="mt-1 col-1 px-0"></div>
    <div class="mt-1 col-3 px-0 fs-6 fw-semibold text-primary text-end">
      @rupiah($transaksi->total_harga + $transaksi->ongkos_pengiriman)
    </div>
  </div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalDetail">
    Tutup
  </button>
</div>
