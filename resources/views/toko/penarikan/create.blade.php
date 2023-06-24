<div class="modal-header">
  <h5 class="modal-title">Tambah Penarikan</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form id="formPenarikan" class="modal-body needs-validation" action="{{ route('toko.penarikan.store') }}" method="POST"
  novalidate>
  @csrf
  <div class="mb-3">
    <label class="control-label" for="rekening">Rekening</label>
    <select name="rekening" class="form-select" id="rekening" required>
      <option selected disabled></option>
      @foreach ($rekenings as $r)
        <option value="{{ $r->id }}"> {{ $r->nomor_rekening }} - {{ $r->bank->nama }} - {{ $r->nama_penerima }}
        </option>
      @endforeach
    </select>
  </div>

  <div>
    <label class="form-label" for="nominal">Nominal</label>
    <input type="number" class="form-control" id="nominal" placeholder="Nominal (maks: @rupiah($toko->saldo))"
      name="nominal" max="{{ $toko->saldo }}" min="1" required>
    <div id="nominalMsg" class="invalid-feedback"></div>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  <button id="btnSubmit" type="submit" form="formPenarikan" class="btn btn-primary">Tambah</button>
</div>
