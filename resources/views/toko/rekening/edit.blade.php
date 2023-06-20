<div class="modal-header">
  <h5 class="modal-title">Edit Rekening</h5>
</div>

<form class="modal-body" id="formRekening" action="{{ route('toko.rekening.update', $rekening->id) }}" method="POST">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label class="form-label" for="bank">Bank</label>
    <select class="form-select" id="bank" class="w-100" name="bank" data-placeholder="Pilih bank" required>
      @foreach ($banks as $bank)
        <option value="{{ $bank->id }}" @if ($rekening->bank->id == $bank->id) selected @endif>
          {{ $bank->nama }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label" for="rekening">Nomor Rekening</label>
    <input type="number" name="rekening" id="rekening" class="form-control" value="{{ $rekening->nomor_rekening }}"
      required>
  </div>
  <div>
    <label class="form-label" for="kategoris">Nama Penerima</label>
    <input type="text" name="penerima" id="penerima" class="form-control" value="{{ $rekening->nama_penerima }}"
      required>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Batal</button>
  <button type="submit" form="formRekening" class="btn btn-primary">Ubah</button>
</div>
{{-- @endsection --}}
