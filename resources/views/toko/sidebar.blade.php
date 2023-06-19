@php
  $toko = auth()->user()->toko;
@endphp

<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('toko.hometoko') }}">Skincare Ku Seller</a>
    </div>
    {{-- <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('user.profil.index') }}"></a>
    </div> --}}
    <ul class="sidebar-menu">

      <li class="menu-header">Menu</li>
      <li class="nav-item">
        <a href="{{ route('toko.hometoko') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Home</span>
        </a>
      </li>
      @if ($toko->status == 'diterima')
        <li class="nav-item">
          <a class="nav-link" href="{{ route('toko.barang.index') }}">
            <i class="fas fa-address-card"></i>
            <span>Barang</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('toko.etalase.index') }}">
            <i class="fas fa-address-card"></i>
            <span>Etalase</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('toko.pesanan.index') }}">
            <i class="fas fa-address-card"></i>
            <span>Pesanan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('toko.ekspedisi.index') }}">
            <i class="fas fa-address-card"></i>
            <span>Ekspedisi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('toko.rekening.index') }}">
            <i class="fas fa-address-card"></i>
            <span>Rekening</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('toko.penarikan.index') }}">
            <i class="fas fa-address-card"></i>
            <span>Daftar Penarikan</span>
          </a>
        </li>
      @endif
  </aside>
</div>
