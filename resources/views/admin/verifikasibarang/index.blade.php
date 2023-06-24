@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Verifikasi Barang</h1>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableVerifikasiBarang" class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Nama Toko</th>
                <th>Nama Pemilik Toko</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($verifikasibarangs as $b)
                <tr class="listVerifikasiBarang">
                  <td>{{ $b->id }}</td>
                  <td>{{ $b->nama }}</td>
                  <td>{{ $b->harga }}</td>
                  <td>{{ $b->stok }}</td>
                  <td>{{ $b->toko->nama }}</td>
                  <td>{{ $b->toko->user->nama }}</td>
                  <td class="d-inline-flex justify-content-center w-100">
                    <button class="btnDetailVerifikasiBarang btn btn-sm btn-secondary text-white"
                      data-id="{{ $b->id }}">Detail</button>
                    <button class="btnAksi btn btn-sm btn-primary text-white mx-2" data-id="{{ $b->id }}"
                      data-aksi="diterima">Terima</button>
                    <button class="btnAksi btn btn-sm btn-danger text-white" data-id="{{ $b->id }}"
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

  <form id="formVerifikasi" action="{{ url('admin/verifikasibarang/') }}" method="POST" hidden>
    @method('PATCH')
    @csrf
    <input id="formVerifikasiAksi" name="aksi" />
  </form>

  <div id="modalVerifikasiBarang" class="modal fade" tabindex="-1">
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
        <div id="modalVerifikasiBarangContent"></div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $('.listVerifikasiBarang #btnVerifikasiBarang').click(function() {
        const id = $(this).data('id');
        $('#modalVerifikasiBarang').modal('show');
        $('#modalVerifikasiBarangContent').html('');
        $('#modalLoading').show();
        $.get(`verifikasibarang/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalMemberContent').html(res);
        });
      });

      $('.listVerifikasiBarang .btnDetailVerifikasiBarang').click(function() {
        const id = $(this).data('id');
        $('#modalVerifikasiBarang').modal('show');
        $('#modalVerifikasiBarangContent').html('');
        $('#modalLoading').show();
        $.get(`verifikasibarang/${id}`, function(res) {
          $('#modalLoading').hide();
          $('#modalVerifikasiBarangContent').html(res);
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

      $('#tableVerifikasiBarang').DataTable({
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        },
        columns: [{
            name: 'ID',
            orderable: true
          },
          {
            name: 'Nama Barang',
            orderable: true
          },
          {
            name: 'Harga',
            orderable: true
          },
          {
            name: 'Stok',
            orderable: true
          },
          {
            name: 'Nama Toko',
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
