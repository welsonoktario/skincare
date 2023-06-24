@extends('layouts.toko')
@section('content')
  <h6 class="mt-4 mx-0 mb-0 text-dark">
    Profil Toko
  </h6>

  <div class="card mt-4">
    <div class="card-body">
      <div class="container-fluid">
        <div class="d-flex flex-row justify-content-between">
          <div class="d-flex align-items-center" style="column-gap: 2rem">
            <img class="rounded-circle" src="{{ "/storage/{$toko->foto}" }}" alt="{{ $toko->nama }}" width="100"
              height="100">

            <div class="d-flex flex-column">
              <h6 class="fw-bold my-0">
                {{ $toko->nama }}
                <span class="ms-2">
                  <i class="my-auto fas fa-star text-warning"></i>
                </span>
                <span class="fw-medium text-small text-black-50">{{ $toko->rating ?: 'Belum ada rating' }}</span>
              </h6>
              <p class="my-0 text-black-50">{{ $toko->deskripsi }}</p>
              <p class="my-0">
                <span>
                  <i class="fas fa-map-marker-alt"></i>
                </span>
                {{ $toko->kota->nama }}
              </p>
            </div>
          </div>

          <button id="btnEditProfil" class="btn btn-sm btn-outline-primary shadow-sm" style="height: fit-content;">
            <i class="fas fa-edit fa-sm"></i>
            <span class="ms-1">Ubah</span>
          </button>
        </div>
      </div>
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
      $(document).on('click', '.btn-ganti', function() {
        $('#imgPreview').addClass('d-none');
        $('#inputFile').removeClass('d-none');
        $('input[name="foto"]').prop('required', true);
      });

      $(document).on('change', '#provinsi', function() {
        var selectProvinsi = $(this);
        var selectKota = $('#kota');

        selectKota.prop('disabled', true);
        selectKota.val(null);
        selectKota.find('option')
          .not(':first')
          .remove();

        var id = $(this).val();

        fetch(route('user.checkout.loadKota', {
            provinsi: id
          }))
          .then(res => res.json())
          .then(data => {
            data.forEach(kota => {
              var opt = `<option value="${kota.id}">${kota.nama}</option>`;
              selectKota.append(opt);
            });
          })
          .finally(() => selectKota.prop('disabled', false));
      })

      $('#btnEditProfil').click(function() {
        $('#modalProfil').modal('show');
        $('#modalProfilContent').html('');
        $('#modalLoading').show();

        $.get(route('toko.profil.edit', {{ $toko->id }}), function(res) {
          $('#modalLoading').hide();
          $('#modalProfilContent').html(res);
        });
      });
    });
  </script>
@endpush
