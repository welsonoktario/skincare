<div class="modal-header">
  <h5 class="modal-title">Detail Pengembalian</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalDetail" aria-label="Close"></button>
</div>

<form id="formPengembalian" class="modal-body" action="{{ route('toko.pesanan.update', $pengembalian->transaksi_id) }}"
  method="POST">
  @csrf
  @method('PUT')

  <input type="text" name="pengembalian" class="d-none">
  <input type="text" name="aksi" id="aksiPengembalian" class="d-none">
  <div class="mb-3">
    <label for="alasan" class="form-label">Alasan Pengembalian</label>
    <textarea class="form-control h-100" rows="3" placeholder="Alasan pengembalian" readonly>{{ $pengembalian->alasan }}</textarea>
  </div>

  <p class="mb-1">Foto Pengembalian</p>
  <div class="row">
    @foreach ($pengembalian->fotoPengembalians as $foto)
      <div class="col-6 p-2">
        <img src="{{ "/storage/{$foto->path}" }}" class="w-100 object-fit-contain" style="aspect-ratio: 1 / 1;">
      </div>
    @endforeach
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalDetail">
    Tutup
  </button>
  @if ($pengembalian->status == 'pending')
    <button type="button" class="btn btn-submit btn-danger" data-aksi="ditolak" data-bs-target="#modalDetail">
      Tolak
    </button>
    <button type="button" class="btn btn-submit btn-primary" data-aksi="diterima" data-bs-target="#modalDetail">
      Terima
    </button>
  @endif
</div>
