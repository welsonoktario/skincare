<div class="modal-header">
  <h5 class="modal-title">Detail Barang</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body overflow-y-auto">
  <div class="mb-3">
    <label class="form-label" for="nama_barang">Nama Barang</label>
    <input type="text" class="form-control" value="{{ $barang->nama }}" readonly />
  </div>

  <div class="mb-3">
    <label class="form-label" for="stok">Stok Barang</label>
    <input type="number" class="form-control" value="{{ $barang->stok }}" readonly />
  </div>

  <div class="mb-3">
    <label class="form-label" for="harga">Harga Barang</label>
    <input type="number" class="form-control" value="{{ $barang->harga }}" readonly />
  </div>

  <div id="diskonWrapper" @class(['row mb-3', 'd-none' => !$barang->jenis_diskon])>
    <div class="col-12">
      <label class="custom-switch">
        <input type="checkbox" id="isDiskon" class="custom-switch-input"
          checked="{{ boolval($barang->nominal_diskon) }}" disabled />
        <span class="custom-switch-indicator"></span>
        <span class="custom-switch-description">Tambah diskon barang</span>
      </label>
    </div>
    <div class="col-5 mt-2 diskon-col">
      <label class="form-label" for="harga">Jenis Diskon</label>
      <select class="form-select" name="jenis_diskon" id="jenisDiskon" disabled>
        <option selected disabled>Pilih jenis diskon</option>
        <option value="persen" @if ($barang->jenis_diskon == 'persen') selected @endif>
          Persen
        </option>
        <option value="nominal" @if ($barang->jenis_diskon == 'nominal') selected @endif>
          Nominal
        </option>
      </select>
    </div>
    <div @class(['col-7 mt-2 diskon-col', 'd-none' => $barang->nominal_diskon])>
      <label class="form-label" for="harga">Nominal Diskon</label>
      <div class="input-group">
        <span @class([
            'input-group-text',
            'd-none' => $barang->jenis_diskon == 'nominal',
        ]) id="igNominal">
          Rp
        </span>
        <input type="number" class="form-control" name="nominal_diskon" value="{{ $barang->nominal_diskon ?: 0 }}" />
        <span @class([
            'input-group-text',
            'd-none' => $barang->jenis_diskon == 'persen',
        ]) id="igPersen">
          %
        </span>
      </div>
    </div>

    <div class="col-12 mt-2 diskon-col d-none">
      <label for="harga_diskon" class="form-label">Harga Setelah Diskon</label>
      <input type="number" class="form-control" value="{{ $barang->harga_diskon }}" readonly />
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label" for="berat">Berat</label>
    <div class="input-group">
      <input type="number" class="form-control" name="berat" value="{{ $barang->berat }}" readonly />
      <span class="input-group-text">gram</span>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label" for="deskripsi">Deskripsi Barang</label>
    <textarea class="form-control h-100" readonly>{{ $barang->deskripsi }}</textarea>
  </div>

  <div class="mb-3">
    <label for="nama" class="form-label">Kandungan Barang</label>
    <input class="form-control" type="text" value="{{ $barang->kandungans->pluck('nama')->implode(', ') }}" readonly>
  </div>

  <div class="mb-3">
    <label class="form-label" for="kategori">Kategori</label>
    <input class="form-control" type="text" value="{{ $barang->kategori ? $barang->kategori->nama : 'Lainnya' }}"
      readonly>
  </div>

  <div class="mb-3">
    <label class="form-label" for="etalase">Etalase</label>
    <input class="form-control" type="text" value="{{ $barang->etalase ? $barang->etalase->nama : '-' }}" readonly>
  </div>

  <div class="row">
    @foreach ($barang->fotos as $foto)
      <div class="col-4 p-2">
        <img src="{{ "/storage/{$foto->path}" }}" width="100%">
      </div>
    @endforeach
  </div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">
    Tutup
  </button>
</div>
