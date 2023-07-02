@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.css">
  <link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" />
@endpush

@section('content')
  <form id="formToko" action="{{ route('toko.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h3 class="text-gray mb-4" class="text-center">Buka Toko</h3>
    <div class="card" style="border-radius: 15px;">
      <div class="card-body">
        <div class="row align-items-center pt-4 pb-3">
          <div class="col-md-3 ps-5">
            <p class="mb-0">Nama Toko</p>
          </div>
          <div class="col-md-9 pe-5">
            <input type="text" name="nama" class="form-control" placeholder="Nama Toko" value="{{ old('nama') }}"
              required />
          </div>
        </div>
        <hr class="mx-n3">
        <div class="row align-items-center py-3">
          <div class="col-md-3 ps-5">
            <label for="deskripsi" class="mb-0 form-label">Deskripsi</label>
          </div>
          <div class="col-md-9 pe-5">
            <textarea name="deskripsi" class="form-control h-100" placeholder="Deskripsi" required>{{ old('deskripsi') }}</textarea>
          </div>
        </div>
        <div class="row align-items-center py-3">
          <div class="col-md-3 ps-5">
            <label for="no_telepon" class="mb-0 form-label">No. Telepon</label>
          </div>
          <div class="col-md-9 pe-5">
            <input type="tel" name="no_telepon" class="form-control" placeholder="No Telepon"
              value="{{ old('no_telepon') }}" required />
          </div>
        </div>
        <div class="row align-items-center py-3">
          <div class="col-md-3 ps-5">
            <label for="provinsi" class="mb-0 form-label">Provinsi</label>
          </div>
          <div class="col-md-9 pe-5">
            <select name="provinsi" class="form-select" id="provinsi" required>
              <option selected disabled>Pilih provinsi</option>
              @foreach ($provinsis as $provinsi)
                <option value="{{ $provinsi->id }}" @if (old('provinsi') == $provinsi->id) selected @endif>
                  {{ $provinsi->nama }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row align-items-center py-3">
          <div class="col-md-3 ps-5">
            <label for="kota" class="mb-0 form-label">Kota</label>
          </div>
          <div class="col-md-9 pe-5">
            <select name="kota" class="form-select" id="kota" required disabled>
              <option selected disabled>Pilih kota</option>
            </select>
          </div>
        </div>
        <div class="row align-items-center py-3">
          <div class="col-md-3 ps-5">
            <label for="foto" class="mb-0 form-label">Foto Toko</label>
          </div>
          <div class="col-md-9 pe-5">
            <input type="file" id="foto" name="foto" placeholder="Foto toko" accept="image/*" required />
          </div>
        </div>

        <hr class="mx-n3">

        <div class="float-end py-4">
          <button id="btnSubmit" type="submit" class="btn btn-primary btn-lg">Buka Toko</button>
        </div>
      </div>
    </div>
  </form>
@endsection

@push('scripts')
  <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
  <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
  <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
  <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
  <script>
    $(function() {
      $.fn.filepond.registerPlugin(FilePondPluginImagePreview);

      $('#formToko').submit(function() {
        if (!$('#provinsi').val() || !$('#kota').val()) {
          return false;
        }

        return true;
      })

      $('#foto').filepond({
        name: 'foto',
        storeAsFile: true,
        acceptedFileTypes: ['image/*'],
      });

      $('#provinsi').change(function() {
        var id = $(this).val();
        fetch(route('toko.loadKota', id), {
            header: {
              Accept: 'application/json'
            }
          })
          .then((res) => res.json())
          .then((data) => {
            $('#btnSubmit').prop('disabled', true);
            var kotas = data.kotas;
            $('#kota').prop('disabled', false);
            $('#kota').html('<option selected disabled>Pilih kota</option>');

            kotas.forEach(kota => {
              var opt = `<option value="${kota.id}">${kota.nama}</option>`
              $('#kota').append(opt);
            });
          })
      });

      $('#kota').change(function() {
        $('#btnSubmit').prop('disabled', true);
      });
    });
  </script>
@endpush
