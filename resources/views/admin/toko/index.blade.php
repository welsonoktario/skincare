@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Daftar Toko</h1>
    </div>
    <div class="card shadow mb-3">
      <div class="card-header py-3">
        <div class="card-body">
          <div class="table-responsive">
            <table id="tableToko"class="table table-striped">
              <thead>
                <tr>
                  <th>ID Toko</th>
                  <th>Pemilik Toko</th>
                  <th>Nama Toko</th>
                  <th>Lokasi Toko</th>
                  <th>Deskripsi Toko</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tokos as $t)
                  <tr class="listToko">
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->user->nama }}</td>
                    <td>{{ $t->nama }}</td>
                    <td>{{ "{$t->kota->provinsi->nama}, {$t->kota->nama}" }}</td>
                    <td>{{ $t->deskripsi }}</td>
                    <td>
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
@endsection
@push('scripts')
  <script>
    $('#tableToko').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
      },
      columns: [{
          name: 'Id Toko',
          orderable: true
        },
        {
          name: 'Pemilik Toko',
          orderable: true
        },
        {
          name: 'Nama Toko',
          orderable: true
        },
        {
          name: 'Alamat Toko',
          orderable: true
        },
        {
          name: 'Deskripsi Toko',
          orderable: true
        },
        {
          name: '',
          orderable: false
        }
      ]
    });
  </script>
@endpush
