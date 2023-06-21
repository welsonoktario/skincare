<div class="modal-header">
  <h5 class="modal-title">Detail Toko</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalToko" aria-label="Close"></button>
</div>

<div class="modal-body">
  <div class="row align-items-center pb-3">
    <div class="col-md-3 ps-5">
      <p class="mb-0">Nama Toko</p>
    </div>
    <div class="col-md-9 pe-5">
      <input type="text" name="nama" class="form-control" placeholder="Nama Toko" value="{{ $toko->nama }}"
        readonly />
    </div>
  </div>
  <hr class="mx-n3">
  <div class="row align-items-center py-3">
    <div class="col-md-3 ps-5">
      <label for="deskripsi" class="mb-0 form-label">Deskripsi</label>
    </div>
    <div class="col-md-9 pe-5">
      <textarea name="deskripsi" class="form-control h-100" placeholder="Deskripsi" readonly>{{ $toko->deskripsi }}</textarea>
    </div>
  </div>
  <div class="row align-items-center py-3">
    <div class="col-md-3 ps-5">
      <label for="no_telepon" class="mb-0 form-label">No. Telepon</label>
    </div>
    <div class="col-md-9 pe-5">
      <input type="tel" name="no_telepon" class="form-control" placeholder="No Telepon"
        value="{{ $toko->no_telepon }}" readonly />
    </div>
  </div>
  <div class="row align-items-center py-3">
    <div class="col-md-3 ps-5">
      <label for="provinsi" class="mb-0 form-label">Provinsi</label>
    </div>
    <div class="col-md-9 pe-5">
      <input class="form-control" type="text" name="provinsi" value="{{ $toko->kota->provinsi->nama }}" readonly>
    </div>
  </div>
  <div class="row align-items-center py-3">
    <div class="col-md-3 ps-5">
      <label for="kota" class="mb-0 form-label">Kota</label>
    </div>
    <div class="col-md-9 pe-5">
      <input class="form-control" type="text" name="provinsi" value="{{ $toko->kota->nama }}" readonly>
    </div>
  </div>
  <div class="row align-items-center py-3">
    <div class="col-md-3 ps-5">
      <label for="foto" class="mb-0 form-label">Foto Toko</label>
    </div>
    <div class="col-md-9 pe-5">
      <img src="{{ "/storage/{$toko->foto}" }}" alt="{{ $toko->nama }}" width="150">
    </div>
  </div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalToko">
    Tutup
  </button>
</div>
