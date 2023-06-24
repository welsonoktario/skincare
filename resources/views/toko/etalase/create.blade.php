<form action="{{ route('toko.etalase.store') }}" method="POST">
  @csrf

  <div class="modal-header">
    <h5 class="modal-title">Tambah Etalase</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body">
    @csrf
    <div>
      <label class="form-label" for="nama_etalase">Nama Etalase</label>
      <input type="text" class="form-control" id="nama_etalase" placeholder="Nama etalase" name="nama_etalase"
        required>
    </div>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-primary">Tambah</button>
  </div>
</form>
