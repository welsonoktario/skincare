@extends('user.profil.profil')
@push('styles')
  <link rel="stylesheet" href="https://unpkg.com/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
@endpush
@section('profil-content')
  <form id="formBayar" method="POST" class="d-none">
    @csrf
    @method('PUT')

    <input type="hidden" name="json_callback" id="json_callback2" hidden>
    <input type="hidden" name="status" id="status" hidden>
  </form>

  <div class="d-flex mb-4 w-100 justify-content-between align-items-center">
    <h6 class="mt-2 mx-0 mb-0 text-dark">Daftar Topup</h6>

    <button id="btnTambahTopUp" class="btn btn-sm btn-primary">
      Tambah Saldo
    </button>
  </div>

  <div class="table-responsive">
    <table id="tableTopup" class="table table-striped">
      <thead>
        <tr>
          <th>No.</th>
          <th>Tanggal</th>
          <th>Nominal</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($topups as $u)
          <tr class="listTopup">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $u->created_at }}</td>
            <td>@rupiah($u->nominal)</td>
            <td class="text-capitalize">
              {{ $u->dibayar ? 'Selesai' : 'Menunggu Pembayaran' }}
              @if (!$u->dibayar)
                <p data-id="{{ $u->id }}" data-token="{{ $u->kode_pembayaran }}"
                  class="btnBayar link-primary mb-0 ml-1" style="cursor: pointer">
                  Bayar
                </p>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
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
  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-h7gacNDsOHUce4L3"></script>
  <script src="https://unpkg.com/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $(document).on('click', '.btn-nominal', function() {
        var nominal = $(this).data('nominal');

        $('input[name="nominal"]').val(nominal);
      });

      $(document).on('click', '#btnBayar', function(e) {
        e.preventDefault();

        fetch('/topup/get-topup', {
            method: 'POST',
            headers: {
              Accept: 'application/json',
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({
              total: Number($('input[name="nominal"]').val())
            })
          })
          .then((res) => res.json())
          .then((data) => {
            window.snap.pay(data.snapToken, {
              onSuccess: function(result) {
                $('#token').val(data.snapToken);
                send_response_to_form(result);
              },
              onPending: function(result) {
                $('#token').val(data.snapToken);
                alert(
                  'Harap menyelesaikan pembayaran dalam waktu 24 Jam'
                );
                send_response_to_form(result);
              },
              onError: function(result) {
                alert('Pembayaran gagal');

              },
              onClose: function() {
                alert('Batalkan pembayaran?');
              }
            });
          });

        function send_response_to_form(result) {
          $('#json_callback').val(JSON.stringify(result));
          $('#formTopup').submit();
        }
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
        var token = $(this).data('token');

        window.snap.pay(token, {
          onSuccess: function(result) {
            $('#status').val(true);
            send_response_to_form(id, result);
          },
          onPending: function(result) {
            alert(
              'Harap menyelesaikan pembayaran dalam waktu 24 Jam'
            );
          },
          onError: function(result) {
            alert('Pembayaran gagal');

          },
          onClose: function() {
            alert('Batalkan pembayaran?');
          }
        });

        function send_response_to_form(id, result) {
          $('#json_callback2').val(JSON.stringify(result));

          $('#formBayar').prop('action', route('user.profil.topup.update', id));
          $('#formBayar').submit();
        }
      });

      $('#btnDeletetopup').click(function() {
        $('#modalTopup').modal('show');
        $('#modalTopupContent').html('');
        $('#modalLoading').show();
      });

      $('#tableTopup').DataTable({
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        },
        columns: [{
            name: 'No.',
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
