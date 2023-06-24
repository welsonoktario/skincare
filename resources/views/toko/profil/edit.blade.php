<div class="modal-header">
  <h5 class="modal-title">Ubah Profil</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form class="modal-body" id="formProfil" action="{{ route('toko.profil.update', $toko->id) }}" method="POST"
  enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" class="form-control" name="nama" value="{{ $toko->nama }}" required />
  </div>

  <div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi</label>
    <textarea class="form-control" name="deskripsi" rows="3">{{ $toko->deskripsi }}</textarea>
  </div>

  <div class="mb-3">
    <label for="provinsi" class="form-label">Provinsi</label>
    <select id="provinsi" name="provinsi" class="form-select" required>
      <option selected disabled></option>
      @foreach ($provinsis as $provinsi)
        <option value="{{ $provinsi->id }}" @if ($provinsi->id == $toko->kota->provinsi_id) selected @endif>
          {{ $provinsi->nama }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="kota" class="form-label">Kota</label>
    <select id="kota" name="kota" class="form-select" required>
      <option selected disabled></option>
      @foreach ($kotas as $kota)
        <option value="{{ $kota->id }}" @if ($kota->id == $toko->kota_id) selected @endif>
          {{ $kota->nama }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="telepon" class="form-label">Nomor Telepon</label>
    <input type="tel" class="form-control" value="{{ $toko->no_telepon }}" required />
  </div>

  <div id="imgPreview" class="d-inline-flex flex-column align-items-center w-100">
    <div class="image-preview">
      <img class="object-fit-contain w-100 h-100" src="{{ "/storage/{$toko->foto}" }}" alt="Icon">
    </div>
    <button type="button" class="btn btn-link btn-ganti">Ganti foto</button>
  </div>

  <div id="inputFile" class="d-none">
    <label class="form-label" for="foto">Foto Toko</label>
    <div class="input-group">
      <input name="foto" type="file" class="form-control" accept="image/*">
    </div>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Batal</button>
  <button type="submit" form="formProfil" class="btn btn-primary">Ubah</button>
</div>
