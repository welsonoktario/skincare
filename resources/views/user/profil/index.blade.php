@extends('user.profil.profil')
@section('title', 'Profil • Skincareku')
@section('profil-content')
  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      {{ $errors->first() }}
    </div>
  @endif

  <h6 class="mt-2 mx-0 mb-0 text-dark">
    Akun
  </h6>

  <div class="container-fluid border rounded my-4 py-2">
    <div class="d-sm-flex mb-4 align-items-center justify-content-between">
      <h6 class="mb-0 text-dark fw-semibold">
        Profil
      </h6>
      <button id="btnEditProfil" class="btn btn-sm btn-outline-primary shadow-sm">
        <i class="fas fa-edit fa-sm"></i>
        <span class="ms-1">Ubah</span>
      </button>
    </div>

    <div class="row">
      <div class="col-12 col-md-6">
        <p class="mb-0">Username</p>
        <p class="fw-medium text-dark">{{ $profil->username }}</p>
      </div>

      <div class="col-12 col-md-6">
        <p class="mb-0">Nama</p>
        <p class="fw-medium text-dark">{{ $profil->nama }}</p>
      </div>

      <div class="col-12 col-md-6">
        <p class="mb-0">Email</p>
        <p class="mb-0 fw-medium text-dark">{{ $profil->email }}</p>
      </div>

      <div class="col-12 col-md-6">
        <p class="mb-0">No. HP</p>
        <p class="mb-0 fw-medium text-dark">{{ $profil->no_hp }}</p>
      </div>
    </div>
  </div>

  <div class="container-fluid border rounded mt-4 py-2">
    <div class="d-sm-flex align-items-center justify-content-between">
      <h6 class="mb-0 text-dark fw-semibold">
        Password
      </h6>
      <button id="btnEditPassword" class="btn btn-sm btn-outline-primary shadow-sm">
        <i class="fas fa-edit fa-sm"></i>
        <span class="ms-1">Ubah</span>
      </button>
    </div>
  </div>

  <div id="modalProfil" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">

        {{-- Loading --}}
        <div id="modalLoading" class="row h-100 align-items-center">
          <div class="col align-self-center">
            <div class="d-flex my-5 justify-content-center">
              <div class="spinner-border" role="status">
                <span class="sr-only">Memuat...</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Content --}}
        <div id="modalProfilContent"></div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(function() {
      $('#btnEditProfil').click(function() {
        $('#modalProfil').modal('show');
        $('#modalProfilContent').html('');
        $('#modalLoading').show();

        $.get(route('user.profil.edit', {{ $profil->id }}), function(res) {
          $('#modalLoading').hide();
          $('#modalProfilContent').html(res);
        });
      });

      $('#btnEditPassword').click(function() {
        $('#modalProfil').modal('show');
        $('#modalProfilContent').html('');
        $('#modalLoading').show();

        $.get(route('user.profil.password', {{ $profil->id }}), function(res) {
          $('#modalLoading').hide();
          $('#modalProfilContent').html(res);
        });
      });
    });
  </script>
@endpush
