@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">
        Interaksi Kandungan
      </h1>
      <button type="button" class="btn btn-primary btn-tambah">Tambah Interaksi</button>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableInteraksi" class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Kandungan 1</th>
                <th>Nama Kandungan 2</th>
                <th>Hasil Interaksi</th>
                <th>Deskripsi Interaksi</th>
                <th>Sumber</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($interaksis as $i)
                <tr class="listInteraksi">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $i->kandungan_satu }}</td>
                  <td>{{ $i->kandungan_dua }}</td>
                  <td>{{ $i->jenis }}</td>
                  <td>{{ $i->deskripsi }}</td>
                  <td>{{ $i->sumber }}</td>
                  <td class="d-inline-flex justify-content-center w-100">
                    <button class="btn-edit my-auto btn btn-sm btn-primary text-white mx-2" data-k1="{{ $i->k1_id }}"
                      data-k2="{{ $i->k2_id }}">Ubah</button>
                    <form class="my-auto"
                      action="{{ route('admin.interaksi-kandungan.destroy', ['k1' => $i->k1_id, 'k2' => $i->k2_id]) }}"
                      method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger text-white" data-k1="{{ $i->k1_id }}"
                        data-k2="{{ $i->k2_id }}">Hapus</button>
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

  <div id="modalInteraksi" class="modal fade" tabindex="-1">
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
        <div id="modalInteraksiContent"></div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $(document).on('submit', '#formAddInteraksi', function(e) {
        e.preventDefault();
        var canSubmit = true;

        $('#formAddInteraksi select').each(function(i, el) {
          if (!$(el).val()) {
            canSubmit = false;
            alert('Lengkapi seluruh form');
            return false;
          }
        });

        if (canSubmit) {
          e.currentTarget.submit();
        }
      });

      $('.btn-tambah').click(function() {
        $('#modalInteraksi').modal('show');
        $('#modalInteraksiContent').html('');
        $('#modalLoading').show();
        $.get(`interaksi-kandungan/create`, function(res) {
          $('#modalLoading').hide();
          $('#modalInteraksiContent').html(res);
        });
      });

      $('.listInteraksi .btn-edit').click(function() {
        const {
          k1,
          k2
        } = $(this).data();
        $('#modalInteraksi').modal('show');
        $('#modalInteraksiContent').html('');
        $('#modalLoading').show();
        $.get(`interaksi-kandungan/${k1}/${k2}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalInteraksiContent').html(res);
        });
      });

      $('#tableInteraksi').DataTable();
    });
  </script>
@endpush
