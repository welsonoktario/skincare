{{--
@foreach ($tokos as $k )
{{$k->nama_toko}}
@endforeach --}}
@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Daftar Toko Klontong</h1>
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
                  <th>Pemilik Toko</th>
                  <th>Nama Toko</th>
                  <th>Alamat Toko</th>
                  <th>Deskripsi Toko</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tokos as $t)
                  <tr class="listToko">
                    <td>{{$t->id}}</td>
                    <td>{{$t->user->nama}}</td>
                    <td>{{ $t->nama }}</td>
                    <td>{{ $t->alamat }}</td>
                    <td>{{ $t->deskripsi }}</td>
                    <td>
                      {{-- <button id="btnEditKomponen" data-id="{{ $t->id }}"
                        class="btn btn-sm btn-secondary ms-1 text-white">Edit</button>
                        <form action="{{ route('admin.komponen.destroy', $k->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <input type="submit" value="Hapus" class="btn btn-sm btn-danger"
                              onclick="if(!confirm('Apakah anda yakin?')) return false;" />
                          </form> --}}
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
