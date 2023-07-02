@php
  $toko = auth()->user()->toko;
@endphp

@extends('layouts.toko')
@section('content')
  @if ($toko->status == 'pending')
    <p>Pengajuan toko anda sedang dalam peninjauan</p>
  @elseif ($toko->status == 'ditolak')
    <p>Pengajuan toko anda ditolak</p>
  @else
    <div class="card mt-4">
      <div class="card-body">
        <div class="container-fluid">
          <div class="d-flex flex-row justify-content-between">
            <div class="d-flex align-items-center" style="column-gap: 2rem">
              <img class="rounded-circle" src="{{ "/storage/{$toko->foto}" }}" alt="{{ $toko->nama }}" width="100"
                height="100">

              <div class="d-flex flex-column">
                <h6 class="fw-bold my-0">
                  {{ $toko->nama }}
                  <span class="ms-2">
                    <i class="my-auto fas fa-star text-warning"></i>
                  </span>
                  <span class="fw-medium text-small text-black-50">{{ $toko->rating ?: 'Belum ada rating' }}</span>
                </h6>
                <p class="my-0 text-black-50">
                  {{ $toko->deskripsi }}
                </p>
                <p class="my-0">
                  <span class="me-1">
                    <i class="fas fa-map-marker-alt"></i>
                  </span>
                  {{ $toko->kota->nama }}
                </p>
                <p class="my-0 text-primary fw-semibold">
                  <span class="me-1">
                    <i class="fas fa-wallet"></i>
                  </span>
                  @rupiah($toko->saldo)
                </p>
              </div>
            </div>

            <button id="btnEditProfil" class="btn btn-sm btn-outline-primary shadow-sm"
              style="height: fit-content; white-space: nowrap;">
              <i class="fas fa-edit fa-sm"></i>
              <span class="ms-1">Ubah</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 col-md-4 col-sm-12">
        <div class="card card-statistic-2 overflow-hidden">
          <div style="margin-left: -6px;">
            <canvas id="pendapatan-chart"></canvas>
          </div>
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Pendapatan 30 Hari Terakhir</h4>
            </div>
            <div class="card-body">
              @rupiah($pendapatan['total'])
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-4 col-sm-12">
        <div class="card card-statistic-2 overflow-hidden">
          <div style="margin-left: -6px;">
            <canvas id="transaksi-chart"></canvas>
          </div>
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-receipt"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Transaksi 30 Hari Terakhir</h4>
            </div>
            <div class="card-body">
              {{ $totalTransaksi['total'] }}
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-12">
        <div class="card">
          <div class="card-wrap">
            <div class="card-header">
              <h4 class="mb-0">Produk Terlaris</h4>
            </div>
            <div class="card-body" style="position: relative;">
              <div class="d-flex overflow-x-auto" style="column-gap: 2%">
                @forelse ($terlaris as $barang)
                  <div class="d-flex align-items-center" style="width: 18%">
                    <img class="mr-3 rounded object-fit-contain" height="120" width="120"
                      src="{{ $barang->placeholder }}" alt="product">
                    <div class="media-body ms-3">
                      <div class="float-right">
                        <div class="font-weight-600 text-muted text-small">{{ $barang->terjual }} Terjual</div>
                      </div>
                      <div class="media-title">{{ $barang->nama }}</div>
                    </div>
                  </div>
                @empty
                  <div class="empty-state text-center w-100">
                    <div class="empty-state-icon">
                      <i class="fas fa-question"></i>
                    </div>
                    <h2>Barang Terlaris Kosong</h2>
                    <p class="lead">
                      Anda belum memiliki barang terlaris di toko anda
                    </p>
                    <a href="{{ route('toko.barang.index') }}" class="btn btn-primary mt-4">Tambah Barang</a>
                  </div>
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="modalProfil" class="modal fade" tabindex="-1">
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
          <div id="modalProfilContent"></div>
        </div>
      </div>
    </div>
  @endif
@endsection

@push('scripts-append')
  <script src="https://unpkg.com/chart.js/dist/chart.umd.js"></script>
@endpush

@if ($toko->status == 'diterima')
  @push('scripts')
    <script>
      $(function() {
        var options = {
          maintainAspectRatio: false,
          layout: {
            padding: {
              bottom: -1,
              left: -1
            }
          },
          legend: {
            display: false
          },
          scales: {
            y: {
              grid: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                beginAtZero: true,
                display: false
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
              },
              ticks: {
                display: false
              }
            }
          },
        };
        var pendapatan_chart = document.getElementById("pendapatan-chart").getContext('2d');
        var pendapatan_chart_bg_color = pendapatan_chart.createLinearGradient(0, 0, 0, 70);
        pendapatan_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
        pendapatan_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

        new Chart(pendapatan_chart, {
          type: 'line',
          data: {
            labels: @json($pendapatan['labels']),
            datasets: [{
              label: 'Pendapatan',
              data: @json($pendapatan['data']),
              backgroundColor: pendapatan_chart_bg_color,
              borderWidth: 3,
              borderColor: 'rgba(63,82,227,1)',
              pointBorderWidth: 0,
              pointBorderColor: 'transparent',
              pointRadius: 3,
              pointBackgroundColor: 'transparent',
              pointHoverBackgroundColor: 'rgba(63,82,227,1)',
              borderJoinStyle: 'round'
            }],
          },
          options,
        });

        var transaksi_chart = document.getElementById("transaksi-chart").getContext('2d');
        var transaksi_chart_bg_color = transaksi_chart.createLinearGradient(0, 0, 0, 70);
        transaksi_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
        transaksi_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

        new Chart(transaksi_chart, {
          type: 'line',
          data: {
            labels: @json($totalTransaksi['labels']),
            datasets: [{
              label: 'Transaksi',
              data: @json($totalTransaksi['data']),
              backgroundColor: transaksi_chart_bg_color,
              borderWidth: 3,
              borderColor: 'rgba(63,82,227,1)',
              pointBorderWidth: 0,
              pointBorderColor: 'transparent',
              pointRadius: 3,
              pointBackgroundColor: 'transparent',
              pointHoverBackgroundColor: 'rgba(63,82,227,1)',
              borderJoinStyle: 'round'
            }],
          },
          options,
        });

        $(document).on('click', '.btn-ganti', function() {
          $('#imgPreview').addClass('d-none');
          $('#inputFile').removeClass('d-none');
          $('input[name="foto"]').prop('required', true);
        });

        $(document).on('change', '#provinsi', function() {
          var selectProvinsi = $(this);
          var selectKota = $('#kota');

          selectKota.prop('disabled', true);
          selectKota.val(null);
          selectKota.find('option')
            .not(':first')
            .remove();

          var id = $(this).val();

          fetch(route('user.checkout.loadKota', {
              provinsi: id
            }))
            .then(res => res.json())
            .then(data => {
              data.forEach(kota => {
                var opt = `<option value="${kota.id}">${kota.nama}</option>`;
                selectKota.append(opt);
              });
            })
            .finally(() => selectKota.prop('disabled', false));
        })

        $('#btnEditProfil').click(function() {
          $('#modalProfil').modal('show');
          $('#modalProfilContent').html('');
          $('#modalLoading').show();

          $.get(route('toko.profil.edit', {{ $toko->id }}), function(res) {
            $('#modalLoading').hide();
            $('#modalProfilContent').html(res);
          });
        });
      });
    </script>
  @endpush
@endif
