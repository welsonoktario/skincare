@props(['produk'])

<div class="px-2">
  <div class="card text-decoration-none card-hover px-0 mb-2">
    <img class="card-img-top w-100 object-fit-contain" src="{{ $produk->placeholder }}" style="aspect-ratio: 1 / 1;" />
    <div class="card-body">
      <a href="{{ $produk->kategori ? route('user.kategori.show', $produk->kategori_id) : route('user.kategori.lainnya') }}"
        class="link-info text-decoration-none">{{ $produk->kategori ? $produk->kategori->nama : 'Lainnya' }}</a>
      <p class="fw-medium fs-6">{{ $produk->nama }}</p>
      <div class="d-inline-flex align-items-center fw-semibold h6">
        @if ($produk->nominal_diskon && $produk->harga_diskon >= 0)
          <span class="fw-normal text-decoration-line-through">@rupiah($produk->harga)</span>
          <span class="text-danger mx-1">@rupiah($produk->harga_diskon)</span>
          <div class="badge badge-danger">
            @if ($produk->jenis_diskon == 'persen')
              &dash;{{ $produk->nominal_diskon }}%
            @else
              &dash; @rupiah($produk->nominal_diskon)
            @endif
          </div>
        @else
          @rupiah($produk->harga)
        @endif
      </div>
      <a href="{{ route('user.produk.show', $produk->id) }}" class="stretched-link"></a>
    </div>
  </div>
</div>
