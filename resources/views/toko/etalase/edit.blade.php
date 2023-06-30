<form action="{{ route('toko.etalase.update', $etalases->id) }}" method="POST">
  <div class="modal-header">
    <h5 class="modal-title">Edit Etalase </h5>
    {{-- <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button> --}}
  </div>
  {{-- echo tes; --}}
  <div class="modal-body">
    @method('PUT')
    @csrf
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" id="nama" value="{{ $etalases->nama }}">
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-primary">Ubah</button>
  </div>
</form>
