{{--
  TODO:

  1. Link etalase
  2. Link toko
 --}}
@extends('layouts.app')
@section('title', "{$produk->nama} • Skincare")
@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('user.kategori.index') }}">Kategori</a></li>
      <li class="breadcrumb-item">
        <a href="{{ route('user.kategori.show', $produk->kategori_id) }}">
          {{ $produk->kategori->nama }}
        </a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama }}</li>
    </ol>
  </nav>

  @if (Session::has('success'))
    <div id="alertContainer">
      <div class="alert alert-primary alert-has-icon alert-dismissible show fade">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
          <div class="alert-title">Sukses</div>
          <span>{{ Session::get('success') }}.</span>
          <a href="{{ route('user.keranjang.index') }}" class="alert-link">Lihat keranjang</a>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>
  @endif

  <div class="grid">
    <div class="row">
      {{-- Foto --}}
      <div class="col-12 col-md-6 col-lg-4">
        <div class="sticky-wrapper">
          <div class="w-100 overflow-hidden">
            <img id="fotoProduk" src="{{ $produk->placeholder }}" alt="{{ $produk->nama }}"
              class="d-block w-100 rounded" />
          </div>
          <div class="d-flex flex-row overflow-auto mt-2">
            @foreach ($produk->fotos as $foto)
              @if ($loop->iteration === 1)
                <img src="{{ $foto->path }}" alt="{{ "{$produk->nama} {$foto->id}" }}" role="button"
                  class="w-25 me-2 rounded thumbnail" />
              @elseif($loop->iteration === count($produk->fotos))
                <img src="{{ $foto->path }}" alt="{{ "{$produk->nama} {$foto->id}" }}" role="button"
                  class="w-25 ms-2 rounded thumbnail" />
              @else
                <img src="{{ $foto->path }}" alt="{{ "{$produk->nama} {$foto->id}" }}" role="button"
                  class="w-25 mx-2 rounded thumbnail" />
              @endif
            @endforeach
          </div>
        </div>
      </div>

      {{-- Deskripsi & Ulasan --}}
      <div class="col-12 col-md-6 col-lg-5 mt-3 mt-md-0">
        {{-- Deskripsi produk --}}
        <div class="card mb-2">
          <div class="card-body">
            <h6 class="text-black">{{ $produk->nama }}</h5>
              <h5 class="text-black">@rupiah($produk->harga)</h5>

              <hr>

              <div class="row justify-content-between align-items-center">
                <div class="col-12 col-md-5">
                  <p class="mb-0">Berat Satuan: @berat($produk->berat)</p>
                  <p class="mb-0">
                    Kategori:
                    <a class="link-primary text-decoration-none fw-semibold"
                      href="{{ route('user.kategori.show', $produk->kategori_id) }}">
                      {{ $produk->kategori->nama }}
                    </a>
                  </p>
                  <p class="mb-0">
                    Etalase:
                    <a class="link-primary text-decoration-none fw-semibold"
                      href="{{ $produk->etalase_id ? '#' : '#' }}">
                      {{ $produk->etalase ? $produk->etalase->nama : 'Semua' }}
                    </a>
                  </p>
                </div>

                <div class="col-12 col-md-2 align-self-stretch text-center">
                  <div class="vr h-100 d-none d-md-block mx-auto"></div>
                  <hr class="d-block d-md-none">
                </div>

                <div class="col-12 col-md-5 text-md-center">
                  <div class="d-flex flex-row d-md-inline align-items-center" style="column-gap: 1rem">
                    <img class="rounded-circle mb-md-2" src="{{ $produk->toko->foto ?: 'https://picsum.photos/100' }}"
                      alt="{{ $produk->toko->nama }}" height="64" width="64">
                    <div>
                      <a class="link-primary text-decoration-none fw-semibold mb-0" href="#">
                        {{ $produk->toko->nama }}
                      </a>
                      <p class="mb-0">
                        <i class="fas fa-star fa-xs text-warning"></i>
                        4.8
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <hr>

              <p class="mb-0 text-black">{{ $produk->deskripsi }}</p>
          </div>
        </div>

        {{-- Ulasan produk --}}
        <div class="card">
          <div class="card-header">
            <p class="card-title mb-0 fs-6 fw-semibold text-black">
              Rating & Ulasan
            </p>
          </div>
          @if (count($produk->ulasans))
            <div class="card-body">
              @foreach ($produk->ulasans as $ulasan)
                <x-user.barang.ulasan :ulasan="$ulasan" />

                @if (!$loop->last)
                  <hr>
                @endif
              @endforeach
            </div>
          @else
            <p class="mx-4">Belum ada ulasan produk</p>
          @endif
        </div>
      </div>

      {{-- Tambah Ke Keranjang --}}
      <div class="col-12 col-lg-3">
        <div class="rounded shadow-sm bg-white p-4 keranjang-wrapper sticky-wrapper">
          <h6>Tambah ke keranjang</h6>
          <div class="input-group mb-3">
            <button data-opr="min" class="btn btn-change btn-outline-primary">-</button>
            <input id="inputQty" type="number" placeholder="Jumlah" value="1" min="1"
              max="{{ $produk->stok }}" class="form-control text-center" aria-label="Jumlah">
            <button data-opr="plus" class="btn btn-change btn-outline-primary">+</button>
          </div>
          <p class="text-center text-warning text-small mt-1">Tersisa {{ $produk->stok }} produk tersedia</p>
          <div class="d-flex flex-row w-100 justify-content-between align-items-center">
            <p class="fw-semibold m-0">Subtotal</p>
            <h6 id="subtotal" class="m-0">@rupiah($produk->harga)</h6>
          </div>

          @guest
            <a href="{{ route('login') }}"
              class="btn btn-primary w-100 d-flex align-items-center justify-content-center mt-2"
              style="column-gap: 0.5rem">
              <i class="fas fa-sign-in-alt"></i>
              <span>Masuk</span>
            </a>
          @endguest

          @auth
            <form action="{{ route('user.keranjang.store') }}" method="POST">
              @csrf
              <input type="hidden" value="{{ $produk->id }}" name="barang">
              <input type="hidden" value="{{ $produk->harga }}" name="harga">
              <input id="inputJumlah" type="hidden" value="1" name="jumlah">
              <button type="submit" id="btnKeranjang"
                class="btn btn-primary w-100 d-flex align-items-center justify-content-center mt-2"
                style="column-gap: 0.5rem">
                <i class="fas fa-plus"></i>
                <span>Keranjang</span>
              </button>
            </form>

            @if (count($produk->users))
              <form class="text-center" action="{{ route('user.wishlist.destroy', ['wishlist' => $produk->id]) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="barang" value="{{ $produk->id }}">

                <button class="btn btn-icon text-danger w-100 d-flex align-items-center justify-content-center mt-2"
                  style="column-gap: 0.5rem">
                  <i class="fas fa-heart"></i>
                  <span>Hapus dari Wishlist</span>
                </button>
              </form>
            @else
              <form class="text-center" action="{{ route('user.wishlist.store') }}" method="POST">
                @csrf
                <input type="hidden" name="barang" value="{{ $produk->id }}">

                <button class="btn btn-icon text-primary w-100 d-flex align-items-center justify-content-center mt-2"
                  style="column-gap: 0.5rem">
                  <i class="fas fa-heart"></i>
                  <span>Tambah ke Wishlist</span>
                </button>
              </form>
            @endif
          @endauth
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(function() {
      let produk = @json($produk);
      let qty = $('#inputQty');
      let subtotal = $('#subtotal');
      let foto = $('#fotoProduk');

      // pas input quantity berubah
      qty.change(function() {
        let val = $(this).val()

        if (val < 1) {
          $(this).val(1);
          val = 1;
        }

        updateSubtotal(val);
      });

      // pas tombol min atau plus ditekan
      $('.btn-change').click(function() {
        let opr = $(this).data('opr');

        if (opr === 'plus') {
          if (qty.val() < produk.stok) qty.val(Number(qty.val()) + 1);
        } else if (opr === 'min') {
          if (qty.val() > 1) qty.val(Number(qty.val()) - 1);
        }

        updateSubtotal(qty.val());
      });

      // zoom foto pas posisi mouse di foto
      foto.hover(function() {
        foto.addClass('zoom-in');
      }, function() {
        foto.removeClass('zoom-in');
      });

      // gerakin zoom foto ngikut arah mouse
      foto.on("mousemove", function(e) {
        $(this)
          .css({
            "transform-origin": ((e.pageX - $(this).offset().left) / $(this).width()) * 100 +
              "% " +
              ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +
              "%"
          });
      });

      // ganti foto pas arahin mouse ke foto2 kecil
      $('.thumbnail').hover(function() {
        let src = $(this).prop('src');
        foto.prop('src', src);
      });

      // ubah nilai subtotal
      function updateSubtotal(val) {
        subtotal.text(Number(val * produk.harga).toLocaleString('id-ID', {
          style: 'currency',
          currency: 'IDR',
          maximumFractionDigits: 0
        }));
        $('#inputJumlah').val(val);
      }
    });
  </script>
@endpush
