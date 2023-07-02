@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">
        Zat Aktif
      </h1>
      <button type="button" class="btn btn-primary btn-tambah">Tambah Zat Aktif</button>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableKandungan" class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kandungans as $k)
                <tr class="listKandungan">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $k->nama }}</td>
                  <td class="d-inline-flex justify-content-center w-100">
                    <button class="btn-edit my-auto btn btn-sm btn-primary text-white mx-2"
                      data-id="{{ $k->id }}">Ubah</button>
                    <form class="my-auto" action="{{ route('admin.kandungan.destroy', $k->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger text-white"
                        data-id="{{ $k->id }}">Hapus</button>
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
  <script>
    $(document).ready(function() {
      $(document).on('click', '.btn-ganti', function() {
        $('#imgPreview').addClass('d-none');
        $('#inputFile').removeClass('d-none');
        $('input[name="icon"]').prop('required', true);
      });

      $('.btn-tambah').click(function() {
        $('#modalKandungan').modal('show');
        $('#modalKandunganContent').html('');
        $('#modalLoading').show();
        $.get(`kandungan/create`, function(res) {
          $('#modalLoading').hide();
          $('#modalKandunganContent').html(res);
        });
      });

      $('.listKandungan .btn-edit').click(function() {
        const id = $(this).data('id');
        $('#modalKandungan').modal('show');
        $('#modalKandunganContent').html('');
        $('#modalLoading').show();
        $.get(`kandungan/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalKandunganContent').html(res);
        });
      });

      $('#tableKandungan').DataTable();
    });
  </script>
@endpush
