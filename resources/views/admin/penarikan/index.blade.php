@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
      <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">
        Verifikasi Penarikan
      </h1>
    </div>
    <div class="card shadow mb-3">
      <div class="card-body">
        <div class="table-responsive">
          <table id="tableVerifikasiBarang" class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Nominal</th>
                <th class="text-capitalize">Nama {{ $jenis }}</th>
                <th>Bank</th>
                <th>Rekening</th>
                <th>Nama Penerima</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($penarikans as $p)
                @php
                  $rekening = $p->rekening;
                  $bang = $rekening->bank;
                  $user = $rekening->user;
                  $toko = $user->toko;
                @endphp

                <tr class="listVerifikasiBarang">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y H:i:s') }}</td>
                  <td>@rupiah($p->nominal)</td>
                  <td>{{ $jenis == 'user' ? $user->nama : $toko->nama }}</td>
                  <td>{{ $rekening->bank->nama }}</td>
                  <td class="font-monospace">{{ $rekening->nomor_rekening }}</td>
                  <td>{{ $rekening->nama_penerima }}</td>
                  <td class="d-inline-flex justify-content-center w-100">
                    <button class="btn-aksi btn btn-sm btn-primary text-white mx-2" data-id="{{ $p->id }}"
                      data-aksi="diterima">Terima</button>
                    <button class="btn-aksi btn btn-sm btn-danger text-white" data-id="{{ $p->id }}"
                      data-aksi="ditolak">Tolak</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
