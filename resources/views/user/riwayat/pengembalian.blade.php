<div class="modal-header">
  <h5 class="modal-title">Pengembalian</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalDetail" aria-label="Close"></button>
</div>

<form id="formPengembalian" class="modal-body" action="{{ route('user.transaksi.update', $transaksi->id) }}"
  method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <input type="text" name="pengembalian" class="d-none">
  <div class="mb-3">
    <label for="alasan" class="form-label">Alasan Pengembalian</label>
    <textarea name="alasan" id="alasan" class="form-control h-100" rows="3" placeholder="Alasan pengembalian"
      required></textarea>
  </div>

  <div>
    <label for="fotos" class="form-label">Foto Pengembalian</label>
    <input type="file" name="fotos[]" accept="image/*" data-allow-reorder="true" multiple required />
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalDetail">
    Tutup
  </button>
  <button type="submit" form="formPengembalian" class="btn btn-warning" data-bs-target="#modalDetail">
    Ajukan Pengembalian
  </button>
</div>
