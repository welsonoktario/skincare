{{-- @extends('layouts.admin')
@section('content') --}}
<form action="{{ route('toko.penarikan.store') }}" method="POST" enctype="multipart/form-data">
  <div class="modal-header">
      <h5 class="modal-title">Tambah Nominal</h5>

  </div>
  <div class="modal-body">
      @csrf
      <div class="form-group">
          <label class="control-label col-sm-2" for="nama_etalase">Nominal :</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="Nominal" placeholder="Nominal" name="nominal">
          </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="kategoris">Nomor Rekening :</label>
        <div class="col-sm-10">
            <select name="nomor_rekening" class="form-control" id="nomor_rekening">
                @foreach ($rekenings as $r)
                    <option value="{{ $r->id }}"> {{ $r->nomor_rekening }}</option>
                @endforeach
            </select>
        </div>
        <br>
    </div>
      <br>
  </div>
  <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
{{-- @endsection --}}
