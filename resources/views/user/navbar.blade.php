<nav class="navbar navbar-expand-lg bg-primary-gradient shadow"
  style="position: fixed; top: 0; left:0; right:0; z-index: 999">
  <div class="container">
    <a href="{{ route('user.home') }}">
      <img src="/img/logo2.png" alt="Skincareku" height="40">
    </a>

    <div class="input-group my-auto w-auto d-none d-md-flex" style="padding: 0 auto">
      <input type="search" class="form-control input-search" placeholder="Cari barang atau toko"
        aria-label="Cari barang atau toko" style="box-sizing: border-box">
      <button id="btn-cari" class="btn btn-outline-light shadow-none" style="border-radius: 0 0.35rem 0.35rem 0;"
        type="button">Cari</button>
    </div>

    <ul class="navbar-nav d-flex flex-row align-items-center my-auto" style="column-gap: 0.5rem">
      @auth
        <li class="nav-item">
          <a href="{{ route('user.wishlist.index') }}" role="button" class="nav-link">
            <i class="fas fa-heart"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('user.keranjang.index') }}" role="button" class="nav-link">
            <i class="fas fa-shopping-cart"></i>
          </a>
        </li>
      @endauth
      <li class="nav-item dropdown">
        <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link dropdown-toggle">
          <i class="fas fa-user"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          @auth
            @php
              $toko = auth()->user()->toko;
            @endphp
            <li>
              <a href="{{ route('user.cek-kandungan.index') }}" class="dropdown-item has-icon">
                <i class="fas fa-tasks"></i> Cek Interaksi
              </a>
            </li>
            <li>
              <a href="{{ route('user.profil.index') }}"
                class="dropdown-item has-icon d-flex flex-row align-items-center">
                <i class="fas fa-user"></i>Profil
              </a>
            </li>
            <li>
              <a href="{{ $toko ? route('toko.hometoko') : route('toko.create') }}"
                class="dropdown-item has-icon d-flex flex-row align-items-center">
                <i class="fas fa-store"></i>
                @if ($toko)
                  Toko
                @else
                  Buka Toko
                @endif
              </a>
            </li>
            <li>
              <a href="{{ route('user.transaksi.index') }}"
                class="dropdown-item has-icon d-flex flex-row align-items-center">
                <i class="fas fa-receipt"></i>Pesanan
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="dropdown-item has-icon text-danger d-flex flex-row align-items-center">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          @endauth

          @guest
            <li>
              <a href="{{ route('login') }}" class="dropdown-item has-icon">
                <i class="fas fa-sign-in-alt"></i> Masuk
              </a>
            </li>
            <li>
              <a href="{{ route('user.cek-kandungan.index') }}" class="dropdown-item has-icon">
                <i class="fas fa-tasks"></i> Cek Interaksi
              </a>
            </li>
          @endguest
        </ul>
      </li>
    </ul>

    <div class="input-group d-flex d-md-none mt-1">
      <input type="search" class="form-control input-search" placeholder="Cari barang atau toko"
        aria-label="Cari barang atau toko" aria-describedby="button-addon2">
      <button class="btn btn-primary" type="button">Cari</button>
    </div>
  </div>
</nav>

<div id="searchResult" class="fixed-top w-50 mx-auto overflow-auto d-none"
  style="top: 3rem; left: 0; right: 0; z-index: 70; max-height: 50vh;">
  <div class="list-group w-100" style="border-radius: 0.35rem;">
    <div class="list-group-item">
      <i class="fas fa-bell text-white"></i>
      <span>
        <h6 class="fw-bolder py-3 m-0">Barang</h6>
      </span>
    </div>
    <div id="search-barang-list"></div>
    <h6 class="list-group-item fw-bolder py-3 m-0">Toko</h6>
    <div id="search-toko-list"></div>
  </div>
</div>

@push('scripts')
  <script>
    $(function() {
      var searchInput = $('.input-search');
      var barangList = $('#search-barang-list');
      var tokoList = $('#search-toko-list');
      var searchResult = $('#searchResult');

      searchInput.on("focus", function() {
        searchResult.removeClass('d-none');
      });

      searchInput.on("focusout", function() {
        setTimeout(() => {
          searchResult.addClass('d-none');
        }, 150);
      });

      // pas ngetik di input search, jalanin function search
      searchInput.on('keyup', function(e) {
        search(barangList, tokoList, e.target.value);
      });
    });

    async function search(barangList, tokoList, query) {
      // ambil text yang diketik
      if (query) {
        try {
          // ajax ke controller untuk ambil data
          var res = await fetch(`/search?query=${query}`, {
            headers: {
              Accept: 'application/json'
            },
          });

          // ambil data dari response controller
          var {
            status,
            data,
            msg,
            error
          } = await res.json();

          if (status == 'ok') {
            // data dikirim ke function writeData
            writeData(barangList, tokoList, data);
          } else {
            console.error({
              msg,
              error
            });
          }
        } catch (e) {
          console.error(e);
        }
      } else {
        barangList.html('');
        tokoList.html('');
      }
    }

    function writeData(barangList, tokoList, data) {
      // kosongin hasil pencarian sebelumnya
      barangList.html('');
      tokoList.html('');

      if (data.barangs.length == 0) {
        // kalo hasil barang kosong
        var item = '<div class="list-group-item list-group-item-action">Tidak ada barang</div>';
        barangList.append(item);
      } else {
        // kalo ada barang
        // bikin list barang baru
        data.barangs.forEach(function(barang) {
          var item =
            `<a href="/produk/${barang.id}" class="list-group-item list-group-item-action">${barang.nama}</a>`;
          barangList.append(item);
        });
      }

      if (data.tokos.length == 0) {
        // kalo hasil toko kosong
        var item = '<div class="list-group-item list-group-item-action">Tidak ada toko</div>';
        tokoList.append(item);
      } else {
        // kalo ada toko
        // bikin list toko baru
        data.tokos.forEach(function(toko) {
          var item = `<a href="/toko/${toko.id}" class="list-group-item list-group-item-action">${toko.nama}</a>`;
          tokoList.append(item);
        });
      }
    }
  </script>
@endpush
