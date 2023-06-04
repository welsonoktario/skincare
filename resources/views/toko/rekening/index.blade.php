@extends('layouts.toko')
@section('content')
          <table id="tableEtalase" class="table table-striped">
            <thead>
              <tr>
                <th>Nama Rekening</th>
                <th>No Rekening</th>
                <th>Kode Bank</th>
                <th>Nama Bank</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($rekenings as $r)
                <tr class="listEtalase">
                  <td> {{ $r->nama_penerima }}</td>
                  <td> {{ $r->nomor_rekening }}</td>
                  <td> {{ $r->bank->kode}}</td>
                  <td> {{ $r->bank->nama }}</td>
                  <td>
                  </tr>
            </tbody>
                </table>
                @endforeach
                @endsection
