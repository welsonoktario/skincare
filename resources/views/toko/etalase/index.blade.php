@extends('layouts.toko')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Daftar Etalase</h1>
      <button id="btnTambahEtalase" class="d-sm-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i>
        <span class="ms-1 text-white">Tambah Etalase</span>
      </button>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableEtalase" class="table table-striped">
            <thead>
              <tr>
                <th>Nama Etalase</th>
                <th>'</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($etalases as $e)
                <tr class="listEtalase">
                  <td> {{ $e->nama }}</td>
                  <td>
                    <button id="btnEditEtalase" data-id="{{ $e->id }}"
                      class="btn btn-sm btn-secondary ms-1 text-white">Edit</button>
                      <form action="{{ route('toko.etalase.destroy', $e->id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="Hapus" class="btn btn-sm btn-danger text-white"
                          onclick="if(!confirm('Apakah anda yakin?')) return false"; />
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
  </div>
  </div>
  <div id="modalEtalase" class="modal fade" tabindex="-1">
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
        <div id="modalEtalaseContent"></div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $('#btnTambahEtalase').click(function() {
        $('#modalEtalase').modal('show');
        $('#modalEtalaseContent').html('');
        $('#modalLoading').show();
        $.get(`etalase/create`, function(res) {
          $('#modalLoading').hide();
          $('#modalEtalaseContent').html(res);
        });
      });
      //modal untuk edit etalase
      $('.listEtalase #btnEditEtalase').click(function() {
        const id = $(this).data('id');
        $('#modalEtalase').modal('show');
        $('#modalEtalaseContent').html('');
        $('#modalLoading').show();
        $.get(`etalase/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalEtalaseContent').html(res);
        });
      });
      $('#tableEtalase').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        },
        columns: [{
            name: 'Nama Etalase',
            orderable: true
          },
          {
            name: '',
            orderable: false
          }
        ]
      });
    });
  </script>
@endpush
