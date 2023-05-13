@props(['produk'])

<a href="{{ route('user.produk.show', $produk->id) }}" class="card text-decoration-none card-hover mx-2">
  <img class="card-img-top" src="{{ $produk->placeholder }}" width="100%" />
  <div class="card-body">
    <a href="{{ route('user.kategori.show', $produk->kategori_id) }}"
      class="link-info text-decoration-none">{{ $produk->kategori->nama }}</a>
    <h5>{{ $produk->nama }}</h5>
    <h6>@rupiah($produk->harga)</h6>
  </div>
</a>
