@extends('user.profil.profil')
@section('title', 'Rekening • Skincareku')
@push('styles')
  <link rel="stylesheet" href="https://www.unpkg.com/datatables.net-bs5@1.13.4/css/dataTables.bootstrap5.min.css">
@endpush
@section('profil-content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h6 class="mt-2 mx-0 mb-0 text-dark">
        Daftar Rekening
      </h6>
      <button id="btnTambahRekening" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i>
        <span class="ms-1 text-white">Tambah Rekening</span>
      </button>
    </div>

    <table id="tableRekening" class="table table-striped">
      <thead>
        <tr>
          <th>No.</th>
          <th>Bank</th>
          <th>No. Rekening</th>
          <th>Nama Penerima</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @if (count($rekenings))
          @foreach ($rekenings as $r)
            <tr class="listRekening">
              <td>{{ $loop->iteration }}</td>
              <td> {{ $r->bank->nama }}</td>
              <td> {{ $r->nomor_rekening }}</td>
              <td> {{ $r->nama_penerima }}</td>
              <td>
                <button class="btn btnEditRekening btn-sm btn-secondary ms-1 text-white" data-id="{{ $r->id }}">
                  Edit
                </button>
                <form action="{{ route('toko.etalase.destroy', $r->id) }}" method="POST" class="w-auto d-inline-block">
                  @csrf
                  @method('DELETE')
                  <input type="submit" value="Hapus" class="btn btn-sm btn-danger text-white"
                    onclick="if(!confirm('Apakah anda yakin?')) return false"; />
                </form>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="5" class="text-center">
              Belum ada data
            </td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>

  <div id="modalRekening" class="modal fade" tabindex="-1">
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
        <div id="modalRekeningContent"></div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://www.unpkg.com/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="https://www.unpkg.com/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://www.unpkg.com/select2/dist/js/select2.min.js"></script>
  <script>
    $(function() {
      $('#btnTambahRekening').click(function() {
        $('#modalRekening').modal('show');
        $('#modalRekeningContent').html('');
        $('#modalLoading').show();

        $.get(route('toko.rekening.create'), function(res) {
          $('#modalLoading').hide();
          $('#modalRekeningContent').html(res);
          $('#bank').select2({
            dropdownParent: $('#modalRekening'),
            theme: 'bootstrap-5',
          });
        });
      })

      $('.listRekening .btnEditRekening').click(function() {
        const id = $(this).data('id');
        $('#modalRekening').modal('show');
        $('#modalRekeningContent').html('');
        $('#modalLoading').show();
        $.get(route('user.profil.rekening.edit', id), function(res) {
          $('#modalLoading').hide();
          $('#modalRekeningContent').html(res);
          $('#bank').select2({
            dropdownParent: $('#modalRekening'),
            theme: 'bootstrap-5',
          });
        });
      });

      $('.listRekening .btnEditRekening').click(function() {
        const id = $(this).data('id');
        $('#modalRekening').modal('show');
        $('#modalRekeningContent').html('');
        $('#modalLoading').show();
        $.get(route('user.profil.rekening.edit', id), function(res) {
          $('#modalLoading').hide();
          $('#modalRekeningContent').html(res);
        });
      });

      $('#tableRekening').DataTable({
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        },
        columns: [{
            name: 'No.',
            orderable: true
          },
          {
            name: 'Bank',
            orderable: true
          },
          {
            name: 'No. Rekening',
            orderable: false
          },
          {
            name: 'Nama Penerima',
            orderable: true
          },
          {
            orderable: false
          }
        ]
      });
    });
  </script>
@endpush
