@extends('layouts.toko')
@section('content')
  <h6 class="mt-4 mx-0 mb-0 text-dark">
    Profil Toko
  </h6>


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
