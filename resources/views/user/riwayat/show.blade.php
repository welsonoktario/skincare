<div class="modal-header">
  <h5 class="modal-title">Detail Transaksi</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalDetail" aria-label="Close"></button>
</div>

<div class="modal-body">
  @foreach ($transaksi->transaksiDetails as $td)
    <p>{{ $td->barang->nama }}</p>
  @endforeach
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalDetail">
    Tutup
  </button>
</div>
