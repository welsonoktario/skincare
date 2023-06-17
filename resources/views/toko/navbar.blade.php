@php
  $toko = auth()->user()->toko;
@endphp

<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline me-auto">
    <div class="navbar-nav me-3">
      <li><a href="#" data-bs-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </div>
  </form>
  <ul class="navbar-nav navbar-right">
    </li>
    <li class="dropdown">
      <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <div class="d-sm-none d-lg-inline-block text-center">
          <img src="{{ "/storage/$toko->foto" }}" alt="{{ $toko->nama }}" class="rounded-circle me-2"
            style="width: 2rem; height: 2rem; aspect-ration: 1 / 1;">
          <span class="my-auto">{{ $toko->nama }}</span>
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-end">
        <a href="{{ route('toko.profil.index') }}" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profil
        </a>
        <a href="{{ route('user.home') }}" class="dropdown-item has-icon">
          <i class="far fa-user"></i> BACK TO USER
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </li>
  </ul>
</nav>
