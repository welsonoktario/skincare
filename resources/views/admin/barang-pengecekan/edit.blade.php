<div class="modal-header">
  <h5 class="modal-title">Ubah Barang Pengecekan</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalPengecekan"
    aria-label="Close"></button>
</div>

<form id="formAddPengecekan" class="modal-body"
  action="{{ route('admin.barang-pengecekan.update', $barangPengecekan->id) }}" method="POST"
  enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label for="nama" class="form-label">Nama Barang</label>
    <input class="form-control" type="text" name="nama" value="{{ $barangPengecekan->nama }}" required>
  </div>

  <div class="mb-3">
    <label for="nama" class="form-label">Kandungan Barang</label>
    <select id="kandungans" class="form-select select2" name="kandungans[]" data-placeholder="Pilih kandungan" multiple
      required>
      @foreach ($kandungans as $kandungan)
        <option value="{{ $kandungan->id }}" @if (boolval($barangPengecekan->kandungans->contains('id', $kandungan->id))) selected @endif>
          {{ $kandungan->nama }}</option>
      @endforeach
    </select>
  </div>

  <div id="imgPreview" class="d-inline-flex flex-column align-items-center w-100">
    <div class="image-preview">
      <img class="w-100" src="{{ $barangPengecekan->foto }}" alt="Icon">
    </div>
    <button type="button" class="btn btn-link btn-ganti">Ganti foto</button>
  </div>


  <div id="inputFile" class="d-none">
    <label class="form-label" for="foto">Foto Barang</label>
    <input class="form-control" name="foto" type="file" accept="image/*">
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalPengecekan" aria-label>
    Batal
  </button>
  <button form="formAddPengecekan" class="btn btn-primary btn-block">Simpan</button>
</div>
