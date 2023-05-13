<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('toko.hometoko') }}">Ecommerce</a>
    </div>
    {{-- <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('user.profil.index') }}"></a>
    </div> --}}
    <ul class="sidebar-menu">

      <li class="menu-header">Menu</li>
      <li class="nav-item">
        <a href="{{ route('toko.hometoko') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Homee</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('toko.barang.index') }}">
          <i class="fas fa-address-card"></i>
          <span>Barang</span>
        </a>
      </li>
      {{-- <li class="nab-item">
        <a class="nav-link" href="{{route('user.toko.index')}}">
            <i class="fas fa-address-card"></i>
            <span>Toko</span>
        </a>
      </li> --}}
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('#') }}">
          <i class="fas fa-shopping-cart"></i>
          <span>Keranjang</span>
        </a>
      </li> --}}
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('user.pesanan.index') }}">
          <i class="far fa-clock"></i>
          <span>Pesanan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.sedangdisewa.index') }}">
          <i class="fas fa-receipt"></i>
          <span>Sedang disewa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.riwayattransaksi.index') }}">
          <i class="far fa-clock"></i>
          <span>Riwayat Pesanan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.spk.index') }}">
          <i class="far fa-clock"></i>
          <span>Rekomendasi Paket Alat Camping</span>
        </a>
      </li> --}}
      {{-- <li class="menu-header">PERATURAN PERSEWAAN</li>
      <li><a class="nav-link" href="{{ route('admin.riwayattransaksi.index') }}"><i class="fas fa-file  "></i>
          <span>Syarat dan Ketentuan</span></a></li>
      </li> --}}
      {{-- <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-bs-toggle="dropdown">
          <i class="fas fa-columns"></i>
          <span>Rekomendasi Alat Mendaki</span>
        </a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('user.spk.index') }}">SPK</a></li>
        </ul>
      </li> --}}
  </aside>
</div>
