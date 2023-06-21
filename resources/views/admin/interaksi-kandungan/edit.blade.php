<div class="modal-header">
  <h5 class="modal-title">Ubah Interaksi Kandungan</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalInteraksi"
    aria-label="Close"></button>
</div>

<form id="formEditInteraksi"
  action="{{ route('admin.interaksi-kandungan.update', ['k1' => $interaksi->k1_id, 'k2' => $interaksi->k2_id]) }}"
  class="modal-body" method="POST">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label for="k1" class="form-label">Kandungan 1</label>
    <select class="form-select" name="k1" required>
      <option value="0" selected disabled>Pilih kandungan 1</option>
      @foreach ($kandungans as $kandungan)
        <option value="{{ $kandungan->id }}" @if ($kandungan->id == $interaksi->k1_id) selected @endif>
          {{ $kandungan->nama }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="k2" class="form-label">Kandungan 2</label>
    <select class="form-select" name="k2" required>
      <option value="0" selected disabled>Pilih kandungan 2</option>
      @foreach ($kandungans as $kandungan)
        <option value="{{ $kandungan->id }}" @if ($kandungan->id == $interaksi->k2_id) selected @endif>{{ $kandungan->nama }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="jenis" class="form-label">Hasil Interaksi</label>
    <select class="form-select" name="jenis" required>
      <option value="0" selected disabled>Pilih hasil interaksi</option>
      <option value="baik" @if ($interaksi->jenis == 'baik') selected @endif>Baik</option>
      <option value="buruk" @if ($interaksi->jenis == 'buruk') selected @endif>Buruk</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi Interaksi</label>
    <textarea class="form-control h-100" name="deskripsi" placeholder="Deskripsi interaksi" required>{{ $interaksi->deskripsi }}</textarea>
  </div>

  <div class="mb-3">
    <label for="sumber" class="form-label">Sumber</label>
    <input class="form-control" name="sumber" type="text" placeholder="Sumber hasil interaksi"
      value="{{ $interaksi->sumber }}" required>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalInteraksi" aria-label>
    Batal
  </button>
  <button form="formEditInteraksi" class="btn btn-primary btn-block">Ubah</button>
</div>
