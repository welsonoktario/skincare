@extends('layouts.app')
@section('title', 'Keranjang • Skincareku')
@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item">Keranjang</li>
    </ol>
  </nav>

  <h4>Keranjang</h4>

  <div class="mt-4">
    @if (count($keranjangs))
      <div class="row row-cols-12">
        <div class="col-8">
          <table class="table rounded shadow-sm bg-white">
            <thead>
              <tr>
                <th scope="col">Produk</th>
                <th scope="col">Harga Satuan</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Sub Total</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($keranjangs as $toko => $barangs)
                <tr>
                  <td colspan="5">
                    <h6 class="m-0">{{ $toko }}</h6>
                  </td>
                </tr>
                @foreach ($barangs as $barang)
                  <tr>
                    <td class="py-4">
                      <img class="rounded" width="125px" src="{{ $barang->placeholder }}" alt="{{ $barang->nama }}">
                      <p class="fw-semibold text-center">
                        {{ $barang->nama }}
                      </p>

                      <div class="text-small text-dark">
                        <p class="mb-0">Kandungan:</p>
                        <ul>
                          @foreach ($barang->kandungans as $k)
                            <li class="my-0">{{ $k->nama }}</li>
                          @endforeach
                        </ul>
                      </div>
                    </td>
                    <td class="text-right">
                      @if ($barang->hargaDiskon)
                        <span class="fw-normal text-decoration-line-through">@rupiah($barang->harga)</span>
                        <span class="text-danger mx-1">@rupiah($barang->hargaDiskon)</span>
                        <div class="badge badge-danger">
                          @if ($barang->jenis_diskon == 'persen')
                            &dash;{{ $barang->nominal_diskon }}%
                          @else
                            &dash; @rupiah($barang->nominal_diskon)
                          @endif
                        </div>
                      @else
                        @rupiah($barang->harga)
                      @endif
                    </td>
                    <td class="text-center">
                      <div class="input-group mx-auto" style="width: 8rem;">
                        <button data-id="{{ $barang->id }}" data-opr="min" class="btn btn-change btn-outline-primary">
                          &dash;
                        </button>
                        <input data-stok="{{ $barang->stok }}" data-harga="{{ $barang->hargaDiskon ?: $barang->harga }}"
                          data-id="{{ $barang->id }}" data-toko="{{ $barang->toko_id }}" type="number"
                          placeholder="Jumlah" value="{{ $barang->pivot->jumlah }}" min="1"
                          max="{{ $barang->stok }}" class="input-qty form-control text-center" aria-label="Jumlah">
                        <button data-id="{{ $barang->id }}" data-opr="plus" class="btn btn-change btn-outline-primary">
                          &plus;
                        </button>
                      </div>
                      <p class="text-stok text-small mt-2 @if ($barang->stok == 0 || !$barang->checkoutable) text-danger @else text-warning @endif"
                        data-id="{{ $barang->id }}">
                        @if (!$barang->checkoutable && $barang->stok > 0)
                          Jumlah produk di keranjang melebihi stok produk
                        @elseif ($barang->stok == 0)
                          Stok produk habis
                        @else
                          Tersisa {{ $barang->stok }} produk tersedia
                        @endif
                      </p>
                    </td>
                    <td class="text-subtotal text-right fw-bold" data-id="{{ $barang->id }}">
                      @if ($barang->hargaDiskon)
                        @rupiah($barang->hargaDiskon * $barang->pivot->jumlah)
                      @else
                        @rupiah($barang->harga * $barang->pivot->jumlah)
                      @endif
                    </td>
                    <td>
                      <form action="{{ route('user.keranjang.destroy', ['keranjang' => $barang->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-icon link-danger" role="button">
                          <i class="far fa-trash-alt"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
                <tr>
                  <td colspan="2"></td>
                  <td>Total Harga</td>
                  <td class="total-harga" data-id="{{ $barang->id }}">@rupiah($barangs->sum(function ($barang) {
                    if ($barang->hargaDiskon) {
                      return $barang->hargaDiskon * $barang->pivot->jumlah;
                    }

                    return $barang->harga * $barang->pivot->jumlah;
                  }))</td>
                  <td>
                    @php
                      $checkoutable = true;

                      foreach ($barangs as $barang) {
                          if (!$barang->checkoutable) {
                              $checkoutable = false;
                              break;
                          }
                      }
                    @endphp
                    <a href="{{ route('user.checkout.index', ['toko' => $barangs[0]->toko_id]) }}"
                      class="btn btn-checkout btn-primary w-100 @if (!$checkoutable) disabled @endif"
                      role="button" data-id="{{ $barangs[0]->toko_id }}">Checkout</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="rounded shadow-sm bg-white p-4 sticky-bottom">
            <h6>Checkout</h6>
            <div class="d-flex flex-row w-100 justify-content-between align-items-center">
              <p class="fw-semibold m-0">Total Harga Keseluruhan</p>
              <h6 id="total" class="m-0">@rupiah($total)</h6>
            </div>

            @php
              $checkoutable = true;

              foreach ($keranjangs as $toko => $barangs) {
                  if (!$checkoutable) {
                      break;
                  }

                  foreach ($barangs as $barang) {
                      if (!$barang->checkoutable) {
                          $checkoutable = false;
                          break;
                      }
                  }
              }
            @endphp

            <a href="{{ route('user.checkout.index') }}"
              class="btn btn-primary w-100 mt-4 @if (!$checkoutable) disabled @endif" role="button">
              Checkout Semua Barang
            </a>
          </div>
        </div>

        <div class="col-4">
          <div class="card">
            <div class="card-header">
              <h6 class="card-title mb-0">Hasil Interaksi Kandungan</h6>
            </div>
            <div class="card-body">
              @foreach ($kandungans as $pasangan => $hasil)
                <h6>{{ $pasangan }}</h6>

                @foreach ($hasil as $k)
                  <div @class([
                      'alert',
                      'alert-success' => $k->jenis_interaksi == 'baik',
                      'alert-danger' => $k->jenis_interaksi == 'buruk',
                  ])>
                    <div class="alert-title text-capitalize">
                      Interaksi {{ $k->jenis_interaksi }}
                    </div>
                    <p class="fw-semibold">
                      <span class="fw-semibold">{{ "{$k->barang_satu} ({$k->kandungan_satu})" }}</span> dan <span
                        class="fw-semibold">{{ "{$k->barang_dua} ({$k->kandungan_dua})" }}</span>
                      @if ($k->jenis_interaksi == 'baik')
                        dapat digunakan dengan bersamaan
                      @elseif ($k->jenis_interaksi == 'buruk')
                        tidak dapat digunakan bersamaan
                      @else
                        tidak memiliki interaksi apapun
                      @endif
                    </p>
                    {{ $k->deskripsi_interaksi }} ({{ $k->sumber }})
                  </div>
                @endforeach
              @endforeach
            </div>
          </div>
        </div>
      </div>
    @else
      <div class="card">
        <div class="card-body">
          <div class="empty-state text-center" data-height="400" style="height: 400px;">
            <div class="empty-state-icon">
              <i class="fas fa-question"></i>
            </div>
            <h2>Keranjang Kosong</h2>
            <p class="lead">
              Anda belum memiliki barang di keranjang anda
            </p>
            <a href="{{ route('user.home') }}" class="btn btn-primary mt-4">Eksplor Barang</a>
          </div>
        </div>
      </div>
    @endif
  </div>
@endsection

@push('scripts')
  <script>
    $(function() {
      // pas input quantity berubah perbarang
      $('.input-qty').change(function() {
        let {
          id,
          harga,
          stok,
          toko
        } = $(this).data();
        let jumlah = $(this).val();

        if (jumlah < 1) {
          $(this).val(1);
          jumlah = 1;
        }

        if (stok > 0) {
          if (jumlah <= stok) {
            $(`.btn-checkout[data-id="${toko}"]`).removeClass('disabled');
            $(`.text-stok[data-id="${id}"]`).text(`Tersisa ${stok} produk tersedia`);
            $(`.text-stok[data-id="${id}"]`).removeClass('text-danger').addClass(
              'text-warning');
          }
        }

        updateSubtotal(id, harga, jumlah);
      });

      // pas tombol min atau plus ditekan perbarang
      $('.btn-change').click(function() {
        let {
          id,
          opr
        } = $(this).data();
        let input = $(`.input-qty[data-id="${id}"]`);
        let jumlah = Number(input.val());
        let {
          id: idBarang,
          harga,
          stok,
          toko
        } = input.data();

        if (opr === 'plus') {
          if (jumlah < stok) jumlah++;
        } else if (opr === 'min') {
          if (jumlah == 1) {
            jumlah = 1;
          } else if (jumlah > 1) {
            jumlah--;
          }
        }

        if (stok > 0) {
          if (jumlah <= stok) {
            $(`.btn-checkout[data-id="${toko}"]`).removeClass('disabled');
            $(`.text-stok[data-id="${idBarang}"]`).text(`Tersisa ${stok} produk tersedia`);
            $(`.text-stok[data-id="${idBarang}"]`).removeClass('text-danger').addClass(
              'text-warning');
          }
        }

        updateSubtotal(id, harga, jumlah);
      });

      // ubah nilai subtotal
      async function updateSubtotal(barang, harga, jumlah) {
        let input = $(`.input-qty[data-id="${barang}"]`);
        let subtotalText = $(`.text-subtotal[data-id="${barang}"]`);
        let subtotal = Number(harga * jumlah);
        let res = await updateKeranjang(barang, harga, jumlah);

        input.val(jumlah);
        subtotalText.text(subtotal.toLocaleString('id-ID', {
          style: 'currency',
          currency: 'IDR',
          maximumFractionDigits: 0
        }));
        $(`.total-harga[data-id="${barang}"]`).text(subtotal.toLocaleString('id-ID', {
          style: 'currency',
          currency: 'IDR',
          maximumFractionDigits: 0
        }));
        $('#total').text(Number(res.data.total).toLocaleString('id-ID', {
          style: 'currency',
          currency: 'IDR',
          maximumFractionDigits: 0
        }));
      }

      function updateKeranjang(barang, harga, jumlah) {
        let subtotal = Number(jumlah * harga);

        return $.ajax({
          url: route('user.keranjang.update', barang),
          type: 'PUT',
          contentType: 'application/json',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          data: JSON.stringify({
            barang,
            subtotal,
            jumlah
          }),
          dataType: 'json'
        });
      }
    });
  </script>
@endpush
