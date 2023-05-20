<div class="grid">
  <div class="row row-cols-1">
    @forelse ($alamats as $alamat)
      <div class="col">
        <a class="card card-alamat text-decoration-none {{ $alamat->is_utama ? 'bg-primary' : '' }} card-primary-hover p-4"
          data-alamat="{{ $alamat }}" role="button">
          @if ($alamat->is_utama)
            <div class="d-inline-flex justify-content-between align-items-center">
              <h6 class="mb-0">{{ $alamat->nama }}</h6>
              <h6 class="mb-0 fw-semibold">Terpilih</h6>
            </div>
          @else
            <h6 class="mb-0">{{ $alamat->nama }}</h6>
          @endif
          <p>{{ $alamat->alamat }}, {{ $alamat->kota->nama }}, {{ $alamat->provinsi->nama }}</p>
          <p class="mb-0">{{ $alamat->penerima }} ({{ $alamat->kontak }})</p>
        </a>
      </div>
    @empty
      <div class="col">
        <a href="{{ route('user.profil.alamat.index') }}" class="btn btn-primary" role="button">
          Tambah Alamat Baru
        </a>
      </div>
    @endforelse
  </div>
</div>
