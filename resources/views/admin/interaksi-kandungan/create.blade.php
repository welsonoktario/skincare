<div class="modal-header">
  <h5 class="modal-title">Tambah Interaksi Zat Aktif</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalInteraksi" aria-label="Close"></button>
</div>

<form id="formAddInteraksi" action="{{ route('admin.interaksi-kandungan.store') }}" class="modal-body" method="POST">
  @csrf

  <div class="mb-3">
    <label for="k1" class="form-label">Zat Aktif 1</label>
    <select class="form-select" name="k1" required>
      <option selected disabled>Pilih zat aktif 1</option>
      @foreach ($kandungans as $kandungan)
        <option value="{{ $kandungan->id }}">{{ $kandungan->nama }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="k2" class="form-label">Zat Aktif 2</label>
    <select class="form-select" name="k2" required>
      <option selected disabled>Pilih zat aktif 2</option>
      @foreach ($kandungans as $kandungan)
        <option value="{{ $kandungan->id }}">{{ $kandungan->nama }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="jenis" class="form-label">Hasil Interaksi</label>
    <select class="form-select" name="jenis" required>
      <option selected disabled>Pilih hasil interaksi</option>
      <option value="baik">Baik</option>
      <option value="buruk">Buruk</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi Interaksi</label>
    <textarea class="form-control h-100" name="deskripsi" placeholder="Deskripsi interaksi" required></textarea>
  </div>

  <div class="mb-3">
    <label for="sumber" class="form-label">Sumber</label>
    <input class="form-control" name="sumber" type="text" placeholder="Sumber hasil interaksi" required>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalInteraksi" aria-label>
    Batal
  </button>
  <button form="formAddInteraksi" class="btn btn-primary btn-block">Tambah</button>
</div>
