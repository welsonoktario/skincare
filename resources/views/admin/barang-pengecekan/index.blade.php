@extends('layouts.admin')

@push('styles')
  <link rel="stylesheet" href="https://unpkg.com/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="https://unpkg.com/select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">
        Barang Pengecekan
      </h1>
      <button type="button" class="btn btn-primary btn-tambah">Tambah Barang</button>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableKandungan" class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kandungan</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($barangPengecekans as $b)
                <tr class="listKandungan">
                  <td>{{ $b->id }}</td>
                  <td>{{ $b->nama }}</td>
                  <td>{{ $b->kandungans }}</td>
                  <td class="d-inline-flex justify-content-center w-100">
                    <button class="btn-edit my-auto btn btn-sm btn-primary text-white mx-2"
                      data-id="{{ $b->id }}">Ubah</button>
                    <form class="my-auto" action="{{ route('admin.barang-pengecekan.destroy', $b->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger text-white"
                        data-id="{{ $b->id }}">Hapus</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div id="modalKandungan" class="modal fade" tabindex="-1">
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
        <div id="modalKandunganContent"></div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://unpkg.com/select2/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $(document).on('click', '.btn-ganti', function() {
        $('#imgPreview').addClass('d-none');
        $('#inputFile').removeClass('d-none');
        $('input[name="foto"]').prop('required', true);
      });

      $('.btn-tambah').click(function() {
        $('#modalKandungan').modal('show');
        $('#modalKandunganContent').html('');
        $('#modalLoading').show();
        $.get(`barang-pengecekan/create`, function(res) {
          $('#modalLoading').hide();
          $('#modalKandunganContent').html(res);
          $('#kandungans').select2({
            theme: 'bootstrap-5'
          });
        });
      });

      $('.listKandungan .btn-edit').click(function() {
        const id = $(this).data('id');
        $('#modalKandungan').modal('show');
        $('#modalKandunganContent').html('');
        $('#modalLoading').show();
        $.get(`barang-pengecekan/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalKandunganContent').html(res);
          $('#kandungans').select2({
            theme: 'bootstrap-5'
          });
        });
      });

      $('#tableKandungan').DataTable();
    });
  </script>
@endpush
