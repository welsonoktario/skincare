@php
    $saldo = auth()->user()->saldo;
@endphp

@extends('layouts.app')
@section('title', 'Checkout • Skincare')
@section('content')
    <div class="container mx-auto bg-white p-4 rounded shadow-sm mt-md-0" style="margin-top: 22%">
        @if (count($keranjangs))
            <form action="{{ route('user.checkout.checkout') }}" enctype="multipart/form-data" method="post" id="submit_form">
                @csrf
                <input type="hidden" name="json" id="json_callback">
                <h4>Alamat Pengiriman</h4>
                <div class="row">
                    <div class="col-12">
                        @if ($alamat )
                            {{-- {{ dd($alamat[0]['id']) }} --}}
                            <input type="hidden" name="alamat" value="{{ $alamat[0]['id'] }}">
                            <a class="card text-decoration-none card-hover" style="cursor: pointer;" role="button"
                                data-bs-toggle="modal" data-bs-target="#modalAlamats">
                                <div class="card-body">
                                    <h6 class="mb-0 alamat-nama">{{ $alamat[0]['nama'] }}</h6>
                                    <p class="alamat-alamat">{{ $alamat[0]['alamat'] }}, {{ $alamat[0]['kota']['nama'] }},
                                        {{ $alamat[0]['provinsi']['nama'] }}
                                    </p>
                                    <p class="mb-0 alamat-kontak">{{ $alamat[0]['penerima'] }} ({{ $alamat[0]['kontak'] }})
                                    </p>
                                </div>
                            </a>
                        @else
                            <a class="card text-decoration-none card-hover" style="cursor: pointer;" role="button"
                                data-bs-toggle="modal" data-bs-target="#modalAlamats">
                                <div class="card-body">
                                    <h6 class="mb-0 alamat-nama">Belum ada alamat</h6>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
                <h4>Detail Barang</h4>
                <table class="table rounded shadow-sm bg-white">
                    <thead>
                        <tr>
                            <th scope="col">Produk</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keranjangs as $toko => $keranjang)
                            <tr>
                                <td colspan="4">
                                    <h6 class="m-0">{{ $toko }}</h6>
                                </td>
                            </tr>
                            @foreach ($keranjang['barangs'] as $barang)
                                <tr>
                                    <td class="py-4">
                                        <img class="rounded" height="125px" src="{{ $barang->placeholder }}"
                                            alt="{{ $barang->nama }}">
                                        <label class="ms-2 fw-semibold">{{ $barang->nama }}</label>
                                    </td>
                                    <td class="text-right">
                                        @rupiah($barang->harga)
                                    </td>
                                    <td class="text-right fw-bold">
                                        x{{ $barang->pivot->jumlah }}
                                    </td>
                                    <td class="text-right fw-bold">
                                        @rupiah($barang->pivot->sub_total)
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-end">
                                    Opsi Pengiriman
                                </td>
                                <td>
                                    <select name="ekspedisis" class="form-select select-ekspedisi text-uppercase"
                                        data-origin="{{ $keranjang['barangs'][0]->toko->kota->id }}"
                                        data-id="{{ $keranjang['barangs'][0]->toko_id }}" aria-label="Opsi pengiriman">
                                        <option value="0" disabled selected>Pilih ekspedisi</option>
                                        @foreach ($keranjang['barangs'][0]->toko->ekspedisis as $ekspedisi)
                                            <option value="{{ $ekspedisi->id }}">{{ $ekspedisi->nama }}</option>
                                        @endforeach
                                    </select>
                                    <select hidden class="form-select select-jenis text-uppercase mt-2"
                                        name="{{ "ongkirs[{$toko}]" }}"
                                        data-origin="{{ $keranjang['barangs'][0]->toko->kota->id }}"
                                        data-id="{{ $keranjang['barangs'][0]->toko_id }}" aria-label="Jenis pengiriman">
                                        <option selected>Pilih jenis pengiriman</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end">
                                    Total Harga Barang
                                </td>
                                <td class="total" data-id="{{ $keranjang['barangs'][0]->toko_id }}"
                                    data-total="{{ $keranjang['total'] }}">
                                    @rupiah($keranjang['total'])</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end">
                                    Ongkos Kirim
                                </td>
                                <td>
                                    <p class="mb-0 text-ongkir" data-id="{{ $keranjang['barangs'][0]->toko_id }}">
                                        @rupiah(0)</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end">
                                    Total Transaksi
                                </td>
                                <td>
                                    <p class="mb-0 text-harga" data-id="{{ $keranjang['barangs'][0]->toko_id }}">-</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="w-100 text-end">
                    <button type="button" class="btn btn-primary btn-pembayaran w-25" data-bs-toggle="modal"
            data-bs-target="#modalPembayaran" >
            Pilih Pembayaran
          </button>

                </div> --}}
                <input type="hidden" name="metode">
            </form>
            <div class="w-100 text-end">
                <a id="pay-button" class="btn btn-primary pay-button" style="text-align: center">Bayar</a>
            </div>
        @else
            <div class="text-center">
                <h1>Keranjang anda kosong</h1>
                <a href="{{ route('user.home') }}" class="btn btn-primary mt-5">
                    Kembali Belanja
                </a>
            </div>
        @endif

    </div>

    <div id="modalAlamats" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAlamatsLabel">Pilih Alamat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-loading text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="modal-body-inner"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div id="modalPembayaran" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive rounded shadow">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2">Metode Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="pembayaran"
                                                id="pembayaranSaldo" value="saldo" checked>
                                            <label class="custom-control-label" for="pembayaranSaldo">
                                                @if ($saldo > $total)
                                                    Saldo
                                                @else
                                                    Saldo tidak mencukupi
                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                    <td>@rupiah($saldo)</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="pembayaran"
                                                id="pembayaranTf" value="transfer">
                                            <label class="custom-control-label" for="pembayaranTf">
                                                Transfer Bank
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button form="formCheckout" type="submit" class="btn btn-primary btn-checkout w-25">
                        Bayar
                    </button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('scripts')
    <script>
        $(function() {
            let selectedAlamat = @json($alamat);
            let loading = $('.modal-loading');
            let ongkir;
            let grandTotal = @json($total);

            // pas modal dibuka, load alamat2 user yg lagi login
            $('#modalAlamats').on('show.bs.modal', function(e) {
                $('.modal-body-inner').html("");
                loading.show();
                loadAlamats();
            });

            // ganti alamat pilihan, trus tutup modal
            $('#modalAlamats').on('click', '.card-alamat', function() {
                let alamat = $(this).data('alamat');
                selectedAlamat = alamat;
                $('#modalAlamats').modal('hide');
            });

            // pas modal udah tertutup, ganti tulisan detail alamat
            $('#modalAlamats').on('hidden.bs.modal', function(e) {
                changeAlamat();
            });

            $('.select-ekspedisi').change(function() {
                $('.btn-pembayaran').prop('disabled', true);
                let kurir = $(this).val();
                let {
                    id,
                    origin
                } = $(this).data();

                loadOngkir(id, kurir, origin, selectedAlamat.kota_id, 1000);
            });

            $('.select-jenis').change(function() {
                $('.btn-pembayaran').prop('disabled', false);
                let id = $(this).data('id');
                let totalToko = Number($(`.total[data-id="${id}"]`).data('total'));
                ongkir = Number($(this).val());
                totalToko += ongkir;
                hitungGrandTotal();

                $(`.text-ongkir[data-id=${id}]`).text(Number(ongkir).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }));

                $(`.text-harga[data-id=${id}]`).text(Number(totalToko).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }))
            });

            $('#formCheckout').submit(function(e) {
                e.preventDefault();
                let metodePembayaran = $('input[type="radio"][name="pembayaran"]:checked').val();
                $('input[name="metode"]').val(metodePembayaran);

                $(this).unbind('submit').submit();
            });

            $('#modalPembayaran').on('show.bs.modal', function() {
                if (grandTotal > {{ $saldo }}) {
                    $('#pembayaranSaldo').prop({
                        'checked': false,
                        'disabled': true
                    });
                    $('#pembayaranTf').prop('checked', true)
                }
            });

            function hitungGrandTotal() {
                let totalOngkir = 0;
                let totalPerToko = $('.select-jenis').each(function(i, el) {
                    let ongkir = $(el).val();

                    if (!isNaN(ongkir)) {
                        totalOngkir += Number(ongkir);
                    }
                });

                return grandTotal + totalOngkir;
            }

            // jalanin ajax ke controller checkout
            function loadAlamats() {
                fetch(route('user.checkout.alamats'))
                    .then(res => res.text())
                    // munculin isi modal dari controller ke modal
                    .then(html => $('.modal-body').html(html))
                    .finally(loading.hide());
            }

            function changeAlamat() {
                $('.alamat-nama').text(selectedAlamat.nama);
                $('.alamat-alamat').text(
                    `${selectedAlamat.alamat}, ${selectedAlamat.kota.nama}, ${selectedAlamat.provinsi.nama}`);
                $('.alamat-kontak').text(`${selectedAlamat.penerima} (${selectedAlamat.kontak})`);
                $('input[name="alamat"]').val(selectedAlamat.id);
            }

            function loadOngkir(id, courier, origin, destination, weight) {
                fetch(route('user.checkout.loadOngkir'), {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify({
                            courier,
                            origin,
                            destination,
                            weight
                        }),
                    })
                    .then(res => res.json())
                    .then(data => {
                        let ro = data.rajaongkir
                        let results = ro.results[0]
                        let jenis = results.costs

                        updateJenisPengiriman(id, jenis)
                    });
            }

            function updateJenisPengiriman(id, jenis) {
                let selectJenis = $(`.select-jenis[data-id=${id}]`);

                selectJenis.html('');
                selectJenis.html('<option value="0" disabled selected>Pilih jenis pengiriman</option>');
                jenis.forEach(j => selectJenis.append(`<option value="${j.cost[0].value}">${j.service}</option>`))
                selectJenis.prop('hidden', false);
            }
        });

        // Count payment gateway
        $(document).ready(function() {
            $(document).on('click', '.pay-button', function() {

                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function() {
                    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                    window.snap.pay('{{ $snap_token }}', {
                        onSuccess: function(result) {
                            /* You may add your own implementation here */
                            console.log(result);
                            send_response_to_form(result);
                        },
                        onPending: function(result) {
                            alert(
                                'Harap menyelesaikan pembayaran dalam waktu 24 Jam'
                            );
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal.');

                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            alert('Batalkan pembayaran ? ');
                        }
                    })
                });

                function send_response_to_form(result) {
                    document.getElementById('json_callback').value = JSON.stringify(result);
                    $('#submit_form').submit();
                }
            });
        });
    </script>
@endpush
