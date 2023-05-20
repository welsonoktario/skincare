@extends('layouts.app')
@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item">Wishlist</li>
    </ol>
  </nav>

  <h4>Wishlist</h4>

  <div class="mt-4">
    @forelse ($wishlists as $wishlist)
      <div class="card shadow mb-3">
        <div class="card-body">
        </div>
      </div>
    @empty
      <div class="card">
        <div class="card-body">
          <div class="empty-state text-center" data-height="400" style="height: 400px;">
            <div class="empty-state-icon">
              <i class="fas fa-question"></i>
            </div>
            <h2>Wishlist Kosong</h2>
            <p class="lead">
              Anda belum memiliki barang wishlist
            </p>
            <a href="{{ route('user.home') }}" class="btn btn-primary mt-4">Eksplor Barang</a>
          </div>
        </div>
      </div>
    @endforelse
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {});
  </script>
@endpush
