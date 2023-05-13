@extends('layouts.app')
@section('title', 'Keranjang • Skincare')
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
                  <img class="rounded" height="125px" src="{{ $barang->placeholder }}" alt="{{ $barang->nama }}">
                  <label class="ms-2 fw-semibold">{{ $barang->nama }}</label>
                </td>
                <td class="text-right">
                  @rupiah($barang->harga)
                </td>
                <td>
                  <div class="input-group" style="width: 8rem;">
                    <button data-id="{{ $barang->id }}" data-opr="min"
                      class="btn btn-change btn-outline-primary">-</button>
                    <input data-stok="{{ $barang->stok }}" data-harga="{{ $barang->harga }}" data-id="{{ $barang->id }}"
                      type="number" placeholder="Jumlah" value="{{ $barang->pivot->jumlah }}" min="1"
                      max="{{ $barang->stok }}" class="input-qty form-control text-center" aria-label="Jumlah">
                    <button data-id="{{ $barang->id }}" data-opr="plus"
                      class="btn btn-change btn-outline-primary">+</button>
                  </div>
                </td>
                <td class="text-subtotal text-right fw-bold" data-id="{{ $barang->id }}">
                  @rupiah($barang->pivot->sub_total)
                </td>
                <td>
                  <div>
                    <a class="link-danger" href="{{ route('user.keranjang.destroy', $barang->id) }}" role="button">
                      <i class="far fa-trash-alt"></i>
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
            <tr>
              <td colspan="2"></td>
              <td>Total Harga</td>
              <td id="totalHarga">@rupiah(
                  $barangs->sum(function ($barang) {
                      return $barang->pivot->sub_total;
                  })
              )</td>
              <td>
                <a href="{{ route('user.checkout.index', ['toko' => $barangs[0]->toko_id]) }}"
                  class="btn btn-primary w-100" role="button">Checkout</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="rounded shadow-sm bg-white p-4 sticky-bottom">
        <h6>Checkout</h6>
        <div class="d-flex flex-row w-100 justify-content-between align-items-center">
          <p class="fw-semibold m-0">Total Harga</p>
          <h6 id="total" class="m-0">@rupiah($total)</h6>
        </div>
        <a href="{{ route('user.checkout.index') }}" class="btn btn-primary w-100 mt-4" role="button">
          Checkout Semua Barang
        </a>
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
@endsection

@push('scripts')
  <script>
    $(function() {
      // pas input quantity berubah perbarang
      $('.input-qty').change(function() {
        let {
          id,
          harga
        } = $(this).data();
        let jumlah = $(this).val();

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
          harga,
          stok
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
        $('#totalHarga').text(Number(res.data.total).toLocaleString('id-ID', {
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
