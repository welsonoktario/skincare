<div class="modal-header">
  <h5 class="modal-title">Tambah Zat Aktif</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalKandungan" aria-label="Close"></button>
</div>

<form id="formAddKandungan" action="{{ route('admin.kandungan.store') }}" class="modal-body" method="POST">
  @csrf

  <div>
    <label for="nama" class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" placeholder="Nama zat aktif" required>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalKandungan" aria-label>
    Batal
  </button>
  <button form="formAddKandungan" class="btn btn-primary btn-block">Tambah</button>
</div>
