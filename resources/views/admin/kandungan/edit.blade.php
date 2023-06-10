<div class="modal-header">
  <h5 class="modal-title">Ubah Kandungan</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalKandungan" aria-label="Close"></button>
</div>

<form id="formEditKandungan" action="{{ route('admin.kandungan.update', $kandungan->id) }}" class="modal-body"
  method="POST">
  @csrf
  @method('PUT')

  <div>
    <label for="nama" class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" placeholder="Nama kandungan" value="{{ $kandungan->nama }}" required>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalKandungan" aria-label>
    Batal
  </button>
  <button form="formEditKandungan" class="btn btn-primary btn-block">Edit</button>
</div>
