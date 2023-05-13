@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Daftar Topup</h1>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableTopup" class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Member</th>
                <th>Tanggal</th>
                <th>Nominal</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($topups as $t)
                <tr class="listTopup">
                  <td>{{ $t->id }}</td>
                  <td>{{ $t->user->nama }}</td>
                  <td>{{ $t->created_at }}</td>
                  <td>{{ $t->nominal }}</td>
                  <td class="text-capitalize">{{ $t->status }}</td>
                  <td class="d-inline-flex justify-content-center w-100">
                    <button class="btnAksi my-auto btn btn-sm btn-primary text-white mx-2" data-id="{{ $t->id }}"
                      data-aksi="diterima">Terima</button>
                    <button class="btnAksi my-auto btn btn-sm btn-danger text-white" data-id="{{ $t->id }}"
                      data-aksi="ditolak">Tolak</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <form id="formTopup" action="{{ url('admin/topup/') }}" method="POST" hidden>
    @method('PATCH')
    @csrf
    <input id="formTopupAksi" name="aksi" />
  </form>
  <div id="modalTopup" class="modal fade" tabindex="-1">
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
        <div id="modalTopupContent"></div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $('.listTopup #btnTopup').click(function() {
        const id = $(this).data('id');
        $('#modalTopup').modal('show');
        $('#modalTopupContent').html('');
        $('#modalLoading').show();
        $.get(`topup/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalTopupContent').html(res);
        });
      });
      $('.btnAksi').click(function() {
        const id = $(this).data('id');
        const aksi = $(this).data('aksi');
        const url = $('#formTopup').attr('action') + `/${id}`;

        $('#formTopup').attr('action', url);
        $('#formTopupAksi').val(aksi);
        $('#formTopup').submit();
      });
      $('#tableTopup').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        },
        columns: [{
            name: 'ID',
            orderable: true
          },
          {
            name: 'Nama Member',
            orderable: true
          },
          {
            name: 'Tanggal',
            orderable: true
          },
          {
            name: 'Nominal',
            orderable: true
          },
          {
            name: 'Status',
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
