@extends('user.app')
@section('content')
  <form action="{{ route('user.verifikasi.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h3 class="text-gray mb-4" class="text-center">Tambah Saldo/h3>
    <div class="card" style="border-radius: 15px;">
      <div class="card-body">
        <hr class="mx-n3">
        <div class="row align-items-center py-3">
          <div class="col-md-3 ps-5">
            <h6 class="mb-0">Saldo   : </h6>
          </div>
          <div class="col-md-9 pe-5">
            <input type="text" name="alamat" class="form-control form-control-lg"
              placeholder="Masukkan Saldo" />
          </div>
        </div>

      </div>
    </div>
  </form>
@endsection
