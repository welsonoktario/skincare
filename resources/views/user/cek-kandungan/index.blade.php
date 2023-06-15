@extends('layouts.app')
@section('title', 'Cek Kandungan • Skincare')
@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item">Keranjang</li>
    </ol>
  </nav>

  <h4>Cek Kandungan</h4>

  <div class="card">
    <form id="formCek" action="{{ route('user.cek-kandungan.cek') }}" class="card-body d-flex justify-content-center w-100 flex-wrap"
      style="column-gap: 1rem;" method="POST">
      @csrf
      <div>
        <label for="barangs[]" class="form-label">
          Barang 1
        </label>
        <select class="form-select" name="barangs[]">
          <option value="0" selected disabled>Pilih barang</option>
          @foreach ($barangs as $barang)
            <option value="{{ $barang->id }}" @if (old('barangs.0') == $barang->id) selected @endif>
              {{ $barang->nama }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="barangs[]" class="form-label">
          Barang 2
        </label>
        <select class="form-select" name="barangs[]">
          <option value="0" selected disabled>Pilih barang</option>
          @foreach ($barangs as $barang)
            <option value="{{ $barang->id }}" @if (old('barangs.1') == $barang->id) selected @endif>
              {{ $barang->nama }}
            </option>
          @endforeach
        </select>
      </div>
      <div style="flex-basis: 100%; height: 0;"></div>
      <button id="btnCek" type="submit" class="btn btn-primary mt-4">Cek Kandungan</button>
    </form>
  </div>

  @if (count($hasilInteraksis))
    <h5>Hasil Interaksi</h5>
    <div class="card">
      <div class="card-header">
        <h6 class="card-title mb-0">
          Hasil Pengecekan Kandungan {{ $namaBarangs[0] }} dan {{ $namaBarangs[1] }}
        </h6>
      </div>
      <div class="card-body row w-100 mt-2">
        @foreach ($hasilInteraksis as $jenis => $hasil)
          <div class="col-4">
            <h6 class="text-capitalize mt-2 mb-1">Interaksi {{ $jenis }}</h6>
            <ul class="list-group">
              @foreach ($hasil as $h)
                <li @class([
                    'list-group-item alert',
                    'alert-success' => $h->jenis_interaksi == 'baik',
                    'alert-danger' => $h->jenis_interaksi == 'buruk',
                    'alert-secondary text-dark' => $h->jenis_interaksi == 'tidak ada',
                ])>
                  <div class="alert-title text-capitalize">
                    Interaksi {{ $h->jenis_interaksi }}
                  </div>
                  <p class="fst-italic">
                    <span class="fw-semibold">{{ $h->barang_satu }} ({{ $h->kandungan_satu }})</span> dan <span
                      class="fw-semibold">{{ $h->barang_dua }} ({{ $h->kandungan_dua }})</span>
                    @if ($h->jenis_interaksi == 'baik')
                      dapat digunakan dengan bersamaan
                    @elseif ($h->jenis_interaksi == 'buruk')
                      tidak dapat digunakan bersamaan
                    @else
                      tidak memiliki interaksi apapun
                    @endif
                  </p>
                  {{ $h->deskripsi_interaksi }} {{ $h->sumber ? "($h->sumber)" : null }}
                </li>
              @endforeach
            </ul>
          </div>
        @endforeach
      </div>
    </div>
  @endif
@endsection

@push('scripts')
  <script>
    $(function() {
      $('#btnCek').click(function(e) {
        e.preventDefault();
        var [barang1, barang2] = $('select[name="barangs[]').map((i, e) => e.value).get();

        if (barang1 == barang2) {
          alert('Barang tidak boleh sama');
          return
        }

        $('#formCek').submit();
      });
    });
  </script>
@endpush
