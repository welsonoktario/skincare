@extends('layouts.app')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Daftar Topup</h1>
      <button id="btnTambahTopUp" class="d-sm-block btn btn-sm btn-primary shadow-sm">Tambah Saldo</button>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableTopup" class="table table-striped">
            <thead>
              <tr>
                <th>ID Topup</th>
                <th>Tanggal</th>
                <th>Nominal</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($topups as $u)
                <tr class="listTopup">
                  <td>{{ $u->id }}</td>
                  <td>{{ $u->created_at }}</td>
                  <td>@rupiah($u->nominal)</td>
                  <td class="text-capitalize">
                    {{ $u->status }}
                    @if ($u->status == 'menunggu pembayaran')
                      <p data-id="{{ $u->id }}" class="btnBayar link-primary mb-0 ml-1" style="cursor: pointer">
                        Bayar
                      </p>
                    @endif
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
      $(document).on('click', '.btn-nominal', function() {
        var nominal = $(this).data('nominal');

        $('input[name="nominal"]').val(nominal);
      });
      $('#btnTambahTopUp').click(function() {
        $('#modalTopup').modal('show');
        $('#modalTopupContent').html('');
        $('#modalLoading').show();
        $.get(`topup/create`, function(res) {
          $('#modalLoading').hide();
          $('#modalTopupContent').html(res);
        });
      });
      $('.btnBayar').click(function() {
        var id = $(this).data('id');
        $('#modalTopup').modal('show');
        $('#modalTopupContent').html('');
        $('#modalLoading').show();
        $.get(`topup/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalTopupContent').html(res);
        });
      });
      $('.listTopup #btnEdittopup').click(function() {
        const id = $(this).data('id');
        $('#modalTopup').modal('show');
        $('#modalTopupContent').html('');
        $('#modalLoading').show();
        $.get(`topup/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalTopupContent').html(res);
        });
      });
      $('#btnDeletetopup').click(function() {
        $('#modalTopup').modal('show');
        $('#modalTopupContent').html('');
        $('#modalLoading').show();
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
          }
        ]
      });
    });
  </script>
@endpush
