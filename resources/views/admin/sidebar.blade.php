<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="#">Ecommerce</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Menu</li>
      <li>
        <a href="{{ route('admin.kategori.index') }}" class="nav-link">
          <i class="fas fa-layer-group"></i>
          <span>Kategori</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.kandungan.index') }}" class="nav-link">
          <i class="fas fa-tint"></i>
          <span>Kandungan</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.interaksi-kandungan.index') }}" class="nav-link">
          <i class="fas fa-exchange-alt"></i>
          <span>Interaksi Kandungan</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.barang-pengecekan.index') }}" class="nav-link">
          <i class="fas fa-check-square"></i>
          <span>Barang Pengecekan</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.member.index') }}" class="nav-link">
          <i class="fas fa-users"></i>
          <span>Daftar User</span>
        </a>
      <li>
      <li class="nav-item">
        <a href="{{ route('admin.toko.index') }}" class="nav-link">
          <i class="fas fa-store"></i>
          <span>Daftar Toko</span>
        </a>
      </li>
      <li class="menu-header">Verifikasi</li>
      <li>
      <li class="nav-item">
        <a href="{{ route('admin.verifikasitoko.index') }}" class="nav-link">
          <i class="fas fa-store-slash"></i>
          <span>Verifikasi Toko</span>
        </a>
      <li>
      <li class="nav-item">
        <a href="{{ route('admin.verifikasibarang.index') }}" class="nav-link">
          <i class="fas fa-file-medical"></i>
          <span>Verifikasi Barang</span>
        </a>
      <li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-bs-toggle="dropdown">
          <i class="fas fa-hand-holding-usd"></i>
          <span>Verifikasi Penarikan</span></a>
        <ul class="dropdown-menu">
          <li>
            <a class="nav-link" href="{{ route('admin.penarikan.index', ['jenis' => 'toko']) }}">
              Toko
            </a>
          </li>
          <li>
            <a class="nav-link" href="{{ route('admin.penarikan.index', ['jenis' => 'user']) }}">
              User
            </a>
          </li>
        </ul>
      </li>
  </aside>
</div>
