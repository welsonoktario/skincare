<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="#">Ecommerce</a>
    </div>
    {{-- <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('user.profil.index') }}"></a>
    </div> --}}
    <ul class="sidebar-menu">

      <li class="menu-header">Menu</li>
      <li class="nav-item">
        <a href="{{ route('admin.homeadmin') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Home</span>
        </a>
      <li>
      <li>
        <a href="{{ route('admin.kategori.index') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Kategori</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.kandungan.index') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Kandungan</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.interaksi-kandungan.index') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Interaksi Kandungan</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.barang-pengecekan.index') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Barang Pengecekan</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.member.index') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Daftar User</span>
        </a>
      <li>
      <li class="nav-item">
        <a href="{{ route('admin.toko.index') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Daftar Toko</span>
        </a>
      </li>
      <li class="menu-header">Verifikasi</li>
      <li>
      <li class="nav-item">
        <a href="{{ route('admin.verifikasitoko.index') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Verifikasi Toko</span>
        </a>
      <li>
      <li class="nav-item">
        <a href="{{ route('admin.verifikasibarang.index') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Verifikasi Barang</span>
        </a>
      <li>
      <li class="nav-item">
        <a href="{{ route('admin.topup.index') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Verifikasi Topup</span>
        </a>
      <li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-bs-toggle="dropdown"><i class="fas fa-columns"></i>
          <span>Verifikasi Penarikan</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('admin.topup.index') }}">Toko</a></li>
          <li><a class="nav-link" href="{{ route('admin.topup.index') }}">User</a></li>
        </ul>
      </li>
  </aside>
</div>
