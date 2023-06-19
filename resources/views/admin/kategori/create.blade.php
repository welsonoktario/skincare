<div class="modal-header">
  <h5 class="modal-title">Tambah Kategori</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalKategori" aria-label="Close"></button>
</div>

<form id="formAddKategori" action="{{ route('admin.kategori.store') }}" class="modal-body" method="POST"
  enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" placeholder="Nama kategori" required>
  </div>

  <div id="inputFile">
    <label class="form-label" for="icon">Icon</label>
    <div class="input-group">
      <input name="icon" type="file" class="form-control" accept="image/*" required>
    </div>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalKategori" aria-label>
    Batal
  </button>
  <button form="formAddKategori" class="btn btn-primary btn-block">Tambah</button>
</div>
