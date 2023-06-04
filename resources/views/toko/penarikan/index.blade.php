@extends('layouts.toko')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between my-4">
            <h1 class="h3 mb-0 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">SALDO ANDA SEKARANG :  <b>{{$tokos->saldo}}</b></h1>
            <button id="btnTambahPenarikan" class="d-sm-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i>
                <span class="ms-1 text-white">TARIK SALDO SEKARANG</span>
            </button>
        </div>
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tablePenarikan" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nominal</th>
                                <th>Tanggal Penarikan</th>
                                <th>Status</th>
                                <th>Nama Bank</th>
                                <th>Nomor Rekening</th>
                                <th>Nama Pemilik Rekening</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penarikans as $p)
                            @foreach ( $rekenings as $r )


                                <tr class="listPenarikan">
                                    {{-- <td> {{ $p->users->nama}}</td> --}}
                                    <td> {{ $p->nominal }}</td>
                                    <td> {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y H:i:s') }}</td>
                                    <td> {{ $p->status }}</td>
                                    <td><{{$r->bank->nama}}</td>
                                    <td>{{$r->nomor_rekening}}</td>
                                    <td>{{$r->nama_penerima}}</td>
                                </tr>
                        </tbody>
                        @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div id="modalPenarikan" class="modal fade" tabindex="-1">
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
                <div id="modalPenarikanContent"></div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#btnTambahPenarikan').click(function() {
                $('#modalPenarikan').modal('show');
                $('#modalPenarikanContent').html('');
                $('#modalLoading').show();
                $.get(`penarikan/create`, function(res) {
                    $('#modalLoading').hide();
                    $('#modalPenarikanContent').html(res);
                });
            });
            $('.listPenarikan .btnDetailPenarikan').click(function() {
                const id = $(this).data('id');
                $('#modalPenarikan').modal('show');
                $('#modalPenarikanContent').html('');
                $('#modalLoading').show();
                $.get(`penarikan/${id}`, function(res) {
                    $('#modalLoading').hide();
                    $('#modalPenarikanContent').html(res);
                });
            });
            $('#tablePenarikan').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
                },
                columns: [{
                        name: 'Nominal',
                        orderable: true
                    },
                    {
                        name: 'Tanggal Penarikan',
                        orderable: true
                    },
                    {
                        name: 'Status',
                        orderable: true
                    },
                    {
                        name: 'Nama Bank',
                        orderable: true
                    },
                    {
                        name: 'Nomor Rekening',
                        orderable: true
                    },
                    {
                        name: 'Nama Pemilik Rekening',
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
