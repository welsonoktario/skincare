@php
  $tipes = [['tipe' => 'menunggu pembayaran', 'label' => 'Menunggu Pembayaran'], ['tipe' => 'menunggu konfirmasi', 'label' => 'Menunggu Konfirmasi'], ['tipe' => 'diproses', 'label' => 'Diproses'], ['tipe' => 'dikirim', 'label' => 'Dikirim'], ['tipe' => 'selesai', 'label' => 'Selesai'], ['tipe' => 'batal', 'label' => 'Dibatalkan'], ['tipe' => 'dikembalikan', 'label' => 'Dikembalikan']];
  $currentTipe = request()->get('tipe') ?: 'semua';
@endphp

@extends('user.profil.profil')
@section('title', 'Daftar Transaksi • Skincareku')

@push('styles')
  <link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.css">
  <link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" />
@endpush

@section('profil-content')
  <h6 class="mt-2 mx-0 mb-0 text-dark">Daftar Transaksi</h6>

  <form id="formPesanan" class="d-none" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="aksi" id="aksi" hidden>
  </form>

  <form id="formPembayaran" class="d-none" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="lanjutkan" hidden>
    <input type="text" name="json_callback" id="json_callback" hidden>
    <input type="text" name="status" id="status" hidden>
  </form>

  <ul class="nav nav-pills nav-fill mt-4">
    <li class="nav-item">
      <a class="nav-link px-2 py-1 {{ $currentTipe == 'semua' ? 'active' : '' }}"
        href="{{ route('user.transaksi.index') }}">Semua</a>
    </li>
    @foreach ($tipes as $tipe)
      <li class="nav-item">
        <a class="nav-link px-2 py-1 {{ $currentTipe == $tipe['tipe'] ? 'active' : '' }}"
          href="?tipe={{ $tipe['tipe'] }}">{{ $tipe['label'] }}</a>
      </li>
    @endforeach
  </ul>
  <div class="mt-4 text-dark list-transaksi">
    @foreach ($transaksis as $transaksi)
      @php
        $toko = $transaksi->toko;
        $transaksiDetails = $transaksi->transaksiDetails;
        $tdCount = count($transaksiDetails);
        $barang = $transaksiDetails[0]->barang;
      @endphp

      <div class="card rounded-2 shadow-sm" style="border: 1px solid var(--primary);">
        <div class="card-body">
          <div class="row">
            <div class="col-9">
              <div class="d-flex flex-row align-items-center" style="column-gap: 1rem">
                <a class="fw-bold link-secondary text-decoration-none"
                  href="{{ route('user.toko.index', $toko->id) }}">{{ $toko->nama }}</a>
                @switch($transaksi->status)
                  @case('menunggu pembayaran')
                    <span class="badge rounded-pill text-bg-warning" style="font-size: 0.6rem">Menunggu Pembayaran</span>
                  @break

                  @case('menunggu konfirmasi')
                    <span class="badge rounded-pill text-bg-secondary" style="font-size: 0.6rem">Menunggu Konfirmasi</span>
                  @break

                  @case('diproses')
                    <span class="badge rounded-pill text-bg-info" style="font-size: 0.6rem">Diproses</span>
                  @break

                  @case('dikirim')
                    <span class="badge rounded-pill text-bg-primary" style="font-size: 0.6rem">Dikirim</span>
                  @break

                  @case('selesai')
                    <span @class([
                        'badge rounded-pill text-capitalize',
                        'text-bg-success' => !$transaksi->pengembalian,
                        'text-bg-danger' => $transaksi->pengembalian,
                    ]) style="font-size: 0.6rem">
                      {{ $transaksi->pengembalian ? "Dikembalikan ({$transaksi->pengembalian->status})" : 'Selesai' }}
                    </span>
                  @break

                  @case('batal')
                    <span class="badge rounded-pill text-bg-danger" style="font-size: 0.6rem">Dibatalkan</span>
                  @break

                  @default
                  @break
                @endswitch
              </div>
              <div class="d-flex flex-row mt-2" style="column-gap: 0.8rem">
                <img class="w-auto rounded" src="{{ $barang->placeholder }}" alt="{{ $barang->nama }}" height="72px">
                <div class="d-flex flex-column justify-content-between">
                  <p class="mb-0">
                    {{ $barang->nama }}
                    @if ($tdCount > 1)
                      <span class="badge rounded-pill text-bg-primary">
                        {{ '+' . ($tdCount - 1) . ' barang lainnya' }}
                      </span>
                    @endif
                  </p>
                  <button class="btn btn-detail btn-outline-primary" data-id="{{ $transaksi->id }}"
                    style="width: fit-content">
                    Detail
                  </button>
                </div>
              </div>
            </div>
            <div class="col-3 d-flex flex-row align-items-center" style="column-gap: 1rem">
              <div class="vr"></div>
              <div>
                <p class="mb-0 text-small">Total Transaksi</p>
                <h6 class="mb-0">@rupiah($transaksi->total_harga + $transaksi->ongkos_pengiriman)</h6>
              </div>
            </div>
          </div>
          @if ($transaksi->status == 'menunggu pembayaran')
            <div class="d-flex mt-3 justify-content-end">
              <button class="btn btn-aksi btn-secondary text-white" data-transaksi="{{ $transaksi->id }}"
                data-aksi="bayar" data-token="{{ $transaksi->kode_pembayaran }}">
                Lanjutkan Pembayaran
              </button>
            </div>
          @elseif ($transaksi->status == 'dikirim' && !$transaksi->pengembalian)
            <div class="d-flex mt-3 justify-content-end">
              <button class="btn btn-aksi btn-secondary text-white" data-transaksi="{{ $transaksi->id }}"
                data-aksi="pengembalian">
                Ajukan Pengembalian
              </button>
              <button class="ms-2 btn btn-aksi btn-primary text-white" data-transaksi="{{ $transaksi->id }}"
                data-aksi="selesai">
                Barang Diterima
              </button>
            </div>
          @elseif ($transaksi->status == 'selesai' && !$transaksi->pengembalian)
            @if ($transaksi->ulasan_count != count($transaksi->transaksiDetails))
              <div class="d-flex mt-3 justify-content-end">
                <button class="btn btn-aksi btn-primary text-white" data-transaksi="{{ $transaksi->id }}"
                  data-aksi="ulasan">
                  Berikan Ulasan
                </button>
              </div>
            @endif
          @endif
        </div>
      </div>
    @endforeach
  </div>

  <div id="modalDetail" class="modal fade" tabindex="-1">
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
        <div id="modalDetailContent"></div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
  <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
  <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
  <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-h7gacNDsOHUce4L3"></script>
  <script>
    $(document).ready(function() {
      $.fn.filepond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType);
      var modalDetail = $('#modalDetail');

      $(document).on('click', '.btn-rating', function() {
        var rating = $(this).data('rating');
        var val = $(this).find('input').val();
        var icon = $(this).find('span');
        $(`#${rating}`).val(val);

        for (var i = 1; i <= 5; i++) {
          if (i <= val) {
            $(`.${rating}-${i}`)
              .removeClass('far')
              .removeClass('fas')
              .addClass('fas');
          } else {
            $(`.${rating}-${i}`)
              .removeClass('far')
              .removeClass('fas')
              .addClass('far');
          }
        }
      });

      $('.btn-detail').click(function() {
        const {
          id,
          aksi
        } = $(this).data();

        modalDetail.modal('show');
        $('#modalDetailContent').html('');
        $('#modalLoading').show();

        $.get(route('user.transaksi.show', id), function(res) {
          $('#modalLoading').hide();
          $('#modalDetailContent').html(res);
        });
      });

      $('.btn-aksi').click(function(e) {
        e.preventDefault();

        var {
          transaksi,
          aksi,
          token
        } = $(this).data();

        if (aksi == 'bayar') {
          window.snap.pay(token, {
            onSuccess: function(result) {
              $('#status').val('menunggu konfirmasi');
              send_response_to_form(transaksi, result);
            },
            onPending: function(result) {
              alert(
                'Harap menyelesaikan pembayaran dalam waktu 24 Jam'
              );
              $('#status').val('menunggu pembayaran');
              send_response_to_form(transaksi, result);
            },
            onError: function(result) {
              alert('Pembayaran gagal.');

            },
            onClose: function() {
              alert('Batalkan pembayaran?');
            }
          });

          function send_response_to_form(id, result) {
            $('#json_callback').val(JSON.stringify(result));
            $('#formPembayaran').prop('action', route('user.transaksi.update', id));
            $('#formPembayaran').submit();
          }

          return;
        }

        modalDetail.modal('show');
        $('#modalDetailContent').html('');
        $('#modalLoading').show();

        if (aksi == 'ulasan') {
          $.get(route('user.transaksi.ulasan', transaksi), function(res) {
            $('#modalLoading').hide();
            $('#modalDetailContent').html(res);
          });
        } else if (aksi == 'pengembalian') {
          $.get(route('user.transaksi.pengembalian', transaksi), function(res) {
            $('#modalLoading').hide();
            $('#modalDetailContent').html(res);

            $('input[name="fotos[]"]').filepond({
              storeAsFile: true,
              maxFiles: 3,
              acceptedFileTypes: ['image/*'],
            });
          });
        } else {
          $('#aksi').val(aksi);

          $('#formPesanan').prop('action', route('user.transaksi.update', transaksi));
          $('#formPesanan').submit();
        }
      });
    });
  </script>
@endpush
