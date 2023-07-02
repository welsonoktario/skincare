<div class="modal-header">
  <h5 class="modal-title">Tambah Barang</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body overflow-y-auto">
  <form id="formAddBarang" action="{{ route('toko.barang.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label" for="nama_barang">Nama Barang</label>
      <input type="text" class="form-control" id="nama" placeholder="Nama barang" name="nama" required>
    </div>

    <div class="mb-3">
      <label class="form-label" for="stok">Stok Barang</label>
      <input type="number" min="0" class="form-control" id="stok" placeholder="Stok barang" name="stok"
        required>
    </div>

    <div class="mb-3">
      <label class="form-label" for="harga">Harga Barang</label>
      <input type="number" min="0"class="form-control" id="harga" placeholder="Harga Barang" name="harga"
        required>
    </div>

    <div id="diskonWrapper" class="row mb-3 d-none">
      <div class="col-12">
        <label class="custom-switch">
          <input type="checkbox" id="isDiskon" class="custom-switch-input">
          <span class="custom-switch-indicator"></span>
          <span class="custom-switch-description">Tambah diskon barang</span>
        </label>
      </div>
      <div class="col-5 mt-2 diskon-col d-none">
        <label class="form-label" for="harga">Jenis Diskon</label>
        <select class="form-select" name="jenis_diskon" id="jenisDiskon">
          <option selected disabled>Pilih jenis diskon</option>
          <option value="persen">Persen</option>
          <option value="nominal">Nominal</option>
        </select>
      </div>
      <div class="col-7 mt-2 diskon-col d-none">
        <label class="form-label" for="harga">Nominal Diskon</label>
        <div class="input-group">
          <span class="input-group-text" id="igNominal">Rp</span>
          <input type="number" min="0" class="form-control" id="nominalDiskon" placeholder="Nominal Diskon"
            name="nominal_diskon">
          <span class="input-group-text" id="igPersen">%</span>
        </div>
      </div>
      <div class="col-12 mt-2 diskon-col d-none">
        <label for="harga_diskon" class="form-label">Harga Setelah Diskon</label>
        <input type="number" class="form-control" id="hargaDiskon" name="harga_diskon" readonly>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label" for="berat">Berat</label>
      <div class="input-group">
        <input type="number" min="1" class="form-control" id="berat" placeholder="Berat barang (gram)"
          name="berat" required>
        <span class="input-group-text">gram</span>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label" for="deskripsi">Deskripsi Barang</label>
      <textarea class="form-control h-100" placeholder="Deskripsi barang" name="deskripsi" required></textarea>
    </div>

    <div class="mb-3">
      <label for="nama" class="form-label">Zat Aktif Barang</label>
      <select id="kandungans" class="form-select select2" name="kandungans[]" data-placeholder="Pilih zat aktif"
        multiple>
        @foreach ($kandungans as $kandungan)
          <option value="{{ $kandungan->id }}">{{ $kandungan->nama }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label" for="kategori">Kategori:</label>
      <select id="kategori" class="form-select select2" name="kategori" data-placeholder="Pilih kategori" required>
        <option selected></option>
        @foreach ($kategoris as $ak)
          <option value="{{ $ak->id }}"> {{ $ak->nama }}</option>
        @endforeach
        <option value="lainnya">Lainnya</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label" for="etalase">Etalase:</label>
      <select name="etalase" class="form-select" id="etalase">
        @if (count($etalases))
          <option value="semua" selected>&dash;</option>
          @foreach ($etalases as $et)
            <option value="{{ $et->id }}"> {{ $et->nama }}</option>
          @endforeach
        @else
          <option value="semua" selected>&dash;</option>
        @endif
      </select>
    </div>

    <div>
      <label for="filepond" class="form-label">Foto Barang</label>
      <input class="form-select" type="file" name="fotos[]" multiple data-allow-reorder="true" required />
    </div>
  </form>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Batal</button>
  <button form="formAddBarang" type="submit" class="btn btn-primary">Tambah</button>
</div>
