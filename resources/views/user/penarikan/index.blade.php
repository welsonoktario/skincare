@extends('user.profil.profil')
@section('title', 'Daftar Penarikan • Skincare')
@push('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush
@section('profil-content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h3 class="mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">
        Daftar Penarikan
      </h3>
      <button id="btnTambahPenarikan" class="d-sm-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i>
        <span class="ms-1 text-white">Tambah Penarikan</span>
      </button>
    </div>

    <p>
      Saldo Anda: <span><b>@rupiah($user->saldo)</b></span>
    </p>

    <div class="table-responsive">
      <table id="tablePenarikan" class="table table-striped">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nominal</th>
            <th>Tanggal Penarikan</th>
            <th>Nama Bank</th>
            <th>Nomor Rekening</th>
            <th>Nama Pemilik Rekening</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($penarikans as $p)
            @php
              $rekening = $p->rekening;
              $bank = $rekening->bank;
            @endphp
            <tr class="listPenarikan">
              <td>{{ $loop->iteration }}</td>
              <td>@rupiah($p->nominal)</td>
              <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y H:i:s') }}</td>
              <td>{{ $bank->nama }}</td>
              <td>{{ $rekening->nomor_rekening }}</td>
              <td>{{ $rekening->nama_penerima }}</td>
              <td class="text-capitalize">{{ $p->status }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div id="modalPenarikan" class="modal fade" tabindex="-1">
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
        <div id="modalPenarikanContent"></div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#btnTambahPenarikan').click(function() {
        $('#modalPenarikan').modal('show');
        $('#modalPenarikanContent').html('');
        $('#modalLoading').show();
        $.get(route('user.profil.penarikan.create'), function(res) {
          $('#modalLoading').hide();
          $('#modalPenarikanContent').html(res);
        });
      });

      $('.listPenarikan .btnDetailPenarikan').click(function() {
        const id = $(this).data('id');
        $('#modalPenarikan').modal('show');
        $('#modalPenarikanContent').html('');
        $('#modalLoading').show();
        $.get(route('user.profil.penarikan.show', id), function(res) {
          $('#modalLoading').hide();
          $('#modalPenarikanContent').html(res);
        });
      });

      $('#tablePenarikan').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
        },
        columns: [{
            name: 'No.',
            orderable: true
          },
          {
            name: 'Nominal',
            orderable: true
          },
          {
            name: 'Tanggal Penarikan',
            orderable: true
          },
          {
            name: 'Nama Bank',
            orderable: true
          },
          {
            name: 'Nomor Rekening',
            orderable: true
          },
          {
            name: 'Nama Pemilik Rekening',
            orderable: true
          },
          {
            name: 'Status',
            orderable: true
          },
        ]
      });
    });
  </script>
@endpush
