@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Kategori</h1>
      <button type="button" class="btn btn-primary btn-tambah">Tambah Kategori</button>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableKategori" class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kategoris as $k)
                <tr class="listKategori">
                  <td>{{ $k->id }}</td>
                  <td>{{ $k->nama }}</td>
                  <td class="d-inline-flex justify-content-center w-100">
                    <button class="btn-edit my-auto btn btn-sm btn-primary text-white mx-2"
                      data-id="{{ $k->id }}">Ubah</button>
                    <form class="my-auto" action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST">
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

  <div id="modalKategori" class="modal fade" tabindex="-1">
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
        <div id="modalKategoriContent"></div>
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
        $('#modalKategori').modal('show');
        $('#modalKategoriContent').html('');
        $('#modalLoading').show();
        $.get(`kategori/create`, function(res) {
          $('#modalLoading').hide();
          $('#modalKategoriContent').html(res);
        });
      });

      $('.listKategori .btn-edit').click(function() {
        const id = $(this).data('id');
        $('#modalKategori').modal('show');
        $('#modalKategoriContent').html('');
        $('#modalLoading').show();
        $.get(`kategori/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalKategoriContent').html(res);
        });
      });

      $('#tableKategori').DataTable();
    });
  </script>
@endpush
