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
      <textarea class="form-control h-100" placeholder="Deskripsi barang" name="deskripsi"></textarea>
    </div>

    <div class="mb-3">
      <label for="nama" class="form-label">Kandungan Barang</label>
      <select id="kandungans" class="form-select select2" name="kandungans[]" data-placeholder="Pilih kandungan"
        multiple required>
        @foreach ($kandungans as $kandungan)
          <option value="{{ $kandungan->id }}">{{ $kandungan->nama }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label" for="kategori">Kategori:</label>
      <select name="kategori" class="form-select" id="kategori" required>
        <option disabled selected>Pilih kategori barang</option>
        @foreach ($kategoris as $ak)
          <option value="{{ $ak->id }}"> {{ $ak->nama }}</option>
        @endforeach
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
      <input class="form-select" type="file" name="fotos[]" multiple data-allow-reorder="true" />
    </div>
  </form>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Batal</button>
  <button form="formAddBarang" type="submit" class="btn btn-primary">Tambah</button>
</div>
