@extends('toko.app')
@section('content')

@section('css')
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between my-4">
    <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Riwayat Transaksi</h1>
  </div>
  <div class="card shadow mb-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi</h6>
    </div>
    <div class="card-body">
      <table class="table" id="tableRiwayatTransaksi" width="100%">
        <thead>
          <tr>
            <th>Id Transaksi</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($riwayattransaksi as $r)
            <tr class="listRiwayatTransaksi">
              <td> {{ $r->id }}</td>
              <td>
                <button class="btnDetailRiwayatTransaksi btn btn-sm btn-primary text-white"
                data-id="{{ $r->id }}">Detail</button>
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
<div id="modalRiwayatTransaksi" class="modal fade" tabindex="-1">
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
      <div id="modalRiwayatTransaksiContent"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('.listRiwayatTransaksi .btnDetailRiwayatTransaksi').click(function() {
      const id = $(this).data('id');
      $('#modalRiwayatTransaksi').modal('show');
      $('#modalRiwayatTransaksiContent').html('');
      $('#modalLoading').show();
      $.get(`riwayattransaksi/${id}`, function(res) {
        $('#modalLoading').hide();
        $('#modalRiwayatTransaksiContent').html(res);
      });
    });
    $('#tableRiwayatTransaksi').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
      },
      columns: [{
          name: 'No',
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
