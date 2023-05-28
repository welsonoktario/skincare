{{-- @extends('admin.app')
@section('content') --}}
<form action="{{ route('toko.etalase.store') }}" method="POST" enctype="multipart/form-data">
  <div class="modal-header">
      <h5 class="modal-title">Tambah Etalase</h5>

  </div>
  <div class="modal-body">
      @csrf
      <div class="form-group">
          <label class="control-label col-sm-2" for="nama_etalase">Nama Etalase :</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_etalase" placeholder="Tulis Etalase" name="nama_etalase">
          </div>
      </div>
      <br>
  </div>
  <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
  </div>
</form>
{{-- @endsection --}}
