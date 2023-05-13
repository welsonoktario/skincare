@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Daftar Member</h1>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableMember" class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Member</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>No_HP</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $u)
                <tr class="listMember">
                    <td>{{$u->id}}</td>
                  <td> {{ $u->nama }}</td>
                  <td> {{ $u->username }}</td>
                  <td> {{ $u->alamat }}</td>
                  <td> {{ $u->no_hp }}</td>
                  <td>
                    <button id="btnEditMember" data-id="{{ $u->id }}"
                      class="btn btn-sm btn-secondary ms-1 text-white">Edit</button>
                      <button class="btnDetailMember btn btn-sm btn-primary text-white"
                      data-id="{{ $u->id }}">Detail</button>
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
  <div id="modalMember" class="modal fade" tabindex="-1">
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
        <div id="modalMemberContent"></div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $('.listMember #btnEditMember').click(function() {
        const id = $(this).data('id');
        $('#modalMember').modal('show');
        $('#modalMemberContent').html('');
        $('#modalLoading').show();
        $.get(`member/${id}/edit`, function(res) {
          $('#modalLoading').hide();
          $('#modalMemberContent').html(res);
        });
      });
      $('#btnTambahMember').click(function() {
        $('#modalMember').modal('show');
        $('#modalMemberContent').html('');
        $('#modalLoading').show();
        $.get(`member/create`, function(res) {
          $('#modalLoading').hide();
          $('#modalMemberContent').html(res);
        });
      });
      $('.listMember .btnDetailMember').click(function() {
        const id = $(this).data('id');
        $('#modalMember').modal('show');
        $('#modalMemberContent').html('');
        $('#modalLoading').show();
        $.get(`member/${id}`, function(res) {
          $('#modalLoading').hide();
          $('#modalMemberContent').html(res);
        });
      });
      $('#tableMember').DataTable({
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
            name: 'Username',
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
            name: '',
            orderable: false
          }
        ]
      });
    });
  </script>
@endpush
