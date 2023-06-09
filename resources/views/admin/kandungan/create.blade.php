<form id="formAddKandungan" action="{{ route('admin.kandungan.store') }}" class="modal-body" method="POST">
  @csrf

  <div>
    <label for="nama" class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" placeholder="Nama kandungan" required>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalKandungan" aria-label>
    Batal
  </button>
  <button form="formAddKandungan" class="btn btn-primary btn-block">Tambah</button>
</div>
