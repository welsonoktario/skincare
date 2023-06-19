@php
  $tipes = [['tipe' => 'menunggu pembayaran', 'label' => 'Menunggu Pembayaran'], ['tipe' => 'menunggu konfirmasi', 'label' => 'Menunggu Konfirmasi'], ['tipe' => 'diproses', 'label' => 'Diproses'], ['tipe' => 'dikirim', 'label' => 'Dikirim'], ['tipe' => 'selesai', 'label' => 'Selesai'], ['tipe' => 'batal', 'label' => 'Dibatalkan'], ['tipe' => 'dikembalikan', 'label' => 'Dikembalikan']];
  $currentTipe = request()->get('tipe') ?: 'semua';
@endphp

@extends('user.profil.profil')
@section('title', 'Daftar Transaksi • Skincare')
@section('profil-content')
  <h6 class="mt-2 mx-0 mb-0 text-dark">Daftar Transaksi</h6>

  <form id="formPesanan" class="d-none" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="aksi" id="aksi" hidden>
  </form>

  <ul class="nav nav-pills nav-fill mt-4">
    <li class="nav-item">
      <a class="nav-link {{ $currentTipe == 'semua' ? 'active' : '' }}" href="{{ route('user.transaksi.index') }}">Semua</a>
    </li>
    @foreach ($tipes as $tipe)
      <li class="nav-item">
        <a class="nav-link {{ $currentTipe == $tipe['tipe'] ? 'active' : '' }}"
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
                    <span class="badge rounded-pill text-bg-success" style="font-size: 0.6rem">Selesai</span>
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
          @if ($transaksi->status == 'dikirim')
            <div class="d-flex mt-3">
              <button class="btn btn-aksi btn-primary text-white" data-transaksi="{{ $transaksi->id }}"
                data-aksi="selesai">Barang Diterima</button>
              <button class="ms-2 btn btn-aksi btn-secondary text-dark" data-transaksi="{{ $transaksi->id }}"
                data-aksi="dikembalikan">Ajukan Pengembalian</button>
            </div>
          @elseif ($transaksi->status == 'selesai')
            <div class="d-flex mt-3">
              <button class="btn btn-primary text-white" data-transaksi="{{ $transaksi->id }}">Ulas</button>
            </div>
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
  <script>
    $(document).ready(function() {
      $('.btn-detail').click(function() {
        const id = $(this).data('id');
        $('#modalDetail').modal('show');
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
          aksi
        } = $(this).data();

        $('#aksi').val(aksi);

        $('#formPesanan').prop('action', route('user.transaksi.update', transaksi));
        $('#formPesanan').submit();
      });

      $('#tableKandungan').DataTable();
    });
  </script>
@endpush
