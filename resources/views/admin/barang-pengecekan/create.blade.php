<div class="modal-header">
  <h5 class="modal-title">Tambah Barang Pengecekan</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalPengecekan"
    aria-label="Close"></button>
</div>

<form id="formAddPengecekan" class="modal-body" action="{{ route('admin.barang-pengecekan.store') }}" method="POST"
  enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label for="nama" class="form-label">Nama Barang</label>
    <input class="form-control" type="text" name="nama" placeholder="Nama barang" required>
  </div>

  <div class="mb-3">
    <label for="nama" class="form-label">Zat Aktif Barang</label>
    <select id="kandungans" class="form-select select2" name="kandungans[]" data-placeholder="Pilih zat aktif" multiple required>
      @foreach ($kandungans as $kandungan)
        <option value="{{ $kandungan->id }}">{{ $kandungan->nama }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="foto" class="form-label">Foto Barang</label>
    <input class="form-control" type="file" name="foto" accept="image/*" required>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalPengecekan" aria-label>
    Batal
  </button>
  <button form="formAddPengecekan" class="btn btn-primary btn-block">Tambah</button>
</div>
