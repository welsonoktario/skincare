@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Daftar Topup</li>
        </ol>
    </nav>
    <div class="d-flex w-100 justify-content-between align-items-center">
        <h4>Daftar Topup</h4>
        <button id="btnTambahTopUp" class="btn btn-sm btn-primary">
            Tambah Saldo
        </button>
    </div>

    <div class="mt-4">
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tableTopup" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Topup</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topups as $u)
                                <tr class="listTopup">
                                    <td>{{ $u->id }}</td>
                                    <td>{{ $u->created_at }}</td>
                                    <td>@rupiah($u->nominal)</td>
                                    <td class="text-capitalize">
                                        {{ $u->status }}
                                        @if ($u->status == 'menunggu pembayaran')
                                            <p data-id="{{ $u->id }}" class="btnBayar link-primary mb-0 ml-1"
                                                style="cursor: pointer">
                                                Bayar
                                            </p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
                {{-- content --}}
                <form action="{{ route('user.topup.topup') }}" enctype="multipart/form-data" method="post"
                    id="formPembayaran">
                    @csrf
                    <input type="hidden" name="json" id="json_callback">
                    <div id="modalPembayaran">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Saldo</h5>
                        </div>
                        <div class="modal-body" id="modalBody">
                            <div class="form-group">
                                <label class="control-label" for="nominal">Nominal</label>
                                <input type="number" class="form-control" id="nominal" placeholder="Masukkan Nominal"
                                    name="nominal" required>
                            </div>
                            <div class="row row-cols-3">
                                <div class="p-1">
                                    <button type="button" id="btn-nominal" class="btn-nominal btn btn-primary mb-0 w-100"
                                        data-nominal="10000">
                                        Rp 10.000
                                    </button>
                                </div>
                                <div class="p-1">
                                    <button type="button" id="btn-nominal2" class="btn-nominal btn btn-primary mb-0 w-100"
                                        data-nominal="50000">
                                        Rp 50.000
                                    </button>
                                </div>
                                <div class="p-1">
                                    <button type="button" id="btn-nominal3" class="btn-nominal btn btn-primary mb-0 w-100"
                                        data-nominal="100000">
                                        Rp 100.000
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" id="btn-pay" class="btn-pay btn btn-primary mb-0 w-100">
                        Bayar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-nominal', function(e) {
                var nominal = $(this).data('nominal');
                $('input[name="nominal"]').val(nominal);

            });
            $('#btnTambahTopUp').click(function() {
                $('#modalTopup').modal('show');
                $('#modalTopupContent').html('');
                $('#modalLoading').hide();
                $('#modalPembayaran').show();
                $.get(`topup/create`, function(res) {
                    $('#modalLoading').hide();
                    $('#modalTopupContent').html(res);
                });
                $(document).on('click', '.btn-pay', function() {
                    $('#modalTopup').modal('hide');
                    fetch('/topup/get-topup', {
                            method: 'POST',
                            headers: {
                                Accept: 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify({
                                total: 1
                            })
                        })
                        .then((res) => res.json())
                        .then((data) => {
                            window.snap.pay(data.snapToken, {
                                onSuccess: function(result) {
                                    send_response_to_form(result);
                                },
                                onPending: function(result) {
                                    alert(
                                        'Harap menyelesaikan pembayaran dalam waktu 24 Jam'
                                    );
                                    send_response_to_form(result);
                                },
                                onError: function(result) {
                                    alert('Pembayaran gagal.');

                                },
                                onClose: function() {
                                    alert('Batalkan pembayaran ? ');
                                }
                            })
                        });
                });

                function send_response_to_form(result) {
                    document.getElementById('json_callback').value = JSON.stringify(result);
                    $('#formPembayaran').submit();
                }
            });
            $('.btnBayar').click(function() {
                var id = $(this).data('id');
                $('#modalTopup').modal('show');
                $('#modalTopupContent').html('');
                $('#modalLoading').show();
                $.get(`topup/${id}/edit`, function(res) {
                    $('#modalLoading').hide();
                    $('#modalTopupContent').html(res);
                });
            });
            $('.listTopup #btnEdittopup').click(function() {
                const id = $(this).data('id');
                $('#modalTopup').modal('show');
                $('#modalTopupContent').html('');
                $('#modalLoading').show();
                $.get(`topup/${id}/edit`, function(res) {
                    $('#modalLoading').hide();
                    $('#modalTopupContent').html(res);
                });
            });
            $('#btnDeletetopup').click(function() {
                $('#modalTopup').modal('show');
                $('#modalTopupContent').html('');
                $('#modalLoading').show();
            });
            $('#tableTopup').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
                },
                columns: [{
                        name: 'ID',
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
