@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Verifikasi Toko</h1>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableVerifikasiToko" class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Toko</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th>Deskripsi</th>
                <th>Nama Pemilik Toko</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($verifikasitokos as $vt)
                <tr class="listVerifikasiToko">
                  <td>{{ $vt->id }}</td>
                  <td>{{ $vt->nama }}</td>
                  <td>{{ $vt->alamat }}</td>
                  <td>{{ $vt->no_telepon }}</td>
                  <td>{{ $vt->telepon }}</td>
                  <td>{{ $vt->user->nama }}</td>
                  <td class="d-inline-flex justify-content-center w-100">
                    <button class="btnDetailVerifikasiToko btn btn-sm btn-secondary text-white"
                      data-id="{{ $vt->id }}">Detail</button>
                    <button class="btnAksi btn btn-sm btn-primary text-white mx-2" data-id="{{ $vt->id }}"
                      data-aksi="diterima">Terima</button>
                    <button class="btnAksi btn btn-sm btn-danger text-white" data-id="{{ $vt->id }}"
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

  <form id="formVerifikasi" action="{{ url('admin/verifikasitoko/') }}" method="POST" hidden>
    @method('PATCH')
    @csrf
    <input id="formVerifikasiAksi" name="aksi" />
  </form>

  <div id="modalToko" class="modal fade" tabindex="-1">
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
        <div id="modalTokoContent"></div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $('.listVerifikasiToko #btnVerifikasiToko').click(function() {
        const id = $(this).data('id');
        $('#modalToko').modal('show');
        $('#modalTokoContent').html('');
        $('#modalLoading').show();
        $.get(`verifikasitoko/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalTokoContent').html(res);
        });
      });

      $('.listVerifikasiToko .btnDetailVerifikasiToko').click(function() {
        const id = $(this).data('id');
        $('#modalToko').modal('show');
        $('#modalTokoContent').html('');
        $('#modalLoading').show();
        $.get(`verifikasitoko/${id}`, function(res) {
          $('#modalLoading').hide();
          $('#modalTokoContent').html(res);
        });
      });

      $('.btnAksi').click(function() {
        const id = $(this).data('id');
        const aksi = $(this).data('aksi');
        const url = $('#formVerifikasi').attr('action') + `/${id}`;

        $('#formVerifikasi').attr('action', url);
        $('#formVerifikasiAksi').val(aksi);
        $('#formVerifikasi').submit();
      });

      $('#tableVerifikasiToko').DataTable({
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        },
        columns: [{
            name: 'ID',
            orderable: true
          },
          {
            name: 'Nama Toko',
            orderable: true
          },
          {
            name: 'Alamat',
            orderable: true
          },
          {
            name: 'No HP',
            orderable: true
          },
          {
            name: 'Deskripsi',
            orderable: true
          },
          {
            name: 'Nama Pemilik Toko',
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
