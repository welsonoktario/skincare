  @extends('user.app')
  @section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Daftar Toko</h1>
      {{-- 6 --}}
    </div>
    <div class="card shadow mb-3">
      <div class="card-header py-3">
        <div class="card-body">
          <div class="table-responsive">
            <table id="tableKomponen"class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Toko</th>
                  <th>Pemilik Toko</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tokos as $t)
                  <tr class="listToko">
                    <td>{{$t->id}}</td>
                    <td>{{ $t->nama_toko }}</td>
                    <td>{{$t->user->nama}}</td>
                    <td></td>
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



