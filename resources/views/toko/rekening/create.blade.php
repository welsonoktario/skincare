<div class="modal-header">
  <h5 class="modal-title">Tambah Rekening</h5>
</div>

<form class="modal-body" id="formRekening" action="{{ route('toko.rekening.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label" for="bank">Bank</label>
    <select class="form-select" id="bank" class="w-100" name="bank" data-placeholder="Pilih bank">
      @foreach ($banks as $bank)
        <option value="{{ $bank->id }}">{{ $bank->nama }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label" for="rekening">Nomor Rekening</label>
    <input type="number" name="rekening" id="rekening" class="form-control" required>
  </div>
  <div>
    <label class="form-label" for="kategoris">Nama Penerima</label>
    <input type="text" name="penerima" id="penerima" class="form-control" required>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Batal</button>
  <button type="submit" form="formRekening" class="btn btn-primary">Tambah</button>
</div>
{{-- @endsection --}}
