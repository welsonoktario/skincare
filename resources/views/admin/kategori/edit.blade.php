<div class="modal-header">
  <h5 class="modal-title">Ubah Kategori</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalKategori" aria-label="Close"></button>
</div>

<form id="formAddKategori" action="{{ route('admin.kategori.update', $kategori->id) }}" class="modal-body" method="POST"
  enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" placeholder="Nama kategori" value="{{ $kategori->nama }}"
      required>
  </div>

  <div id="imgPreview" class="d-inline-flex flex-column align-items-center w-100">
    <div class="image-preview">
      <img class="w-100" src="{{ "/storage/{$kategori->icon}" }}" alt="Icon">
    </div>
    <button type="button" class="btn btn-link btn-ganti">Ganti icon</button>
  </div>


  <div id="inputFile" class="d-none">
    <label class="form-label" for="icon">Icon</label>
    <div class="input-group">
      <input name="icon" type="file" class="form-control" accept="image/*">
    </div>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalKategori" aria-label>
    Batal
  </button>
  <button form="formAddKategori" type="submit" class="btn btn-primary">Ubah</button>
</div>
