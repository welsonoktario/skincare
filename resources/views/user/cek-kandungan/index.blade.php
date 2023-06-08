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

  <form action="{{ route('user.cek-kandungan.cek') }}" class="d-flex justify-content-between w-100 flex-wrap" method="POST">
    @csrf
    @foreach ($kategoris as $kategori)
      <div>
        <label for="barangs[]" class="form-label">
          Kategori {{ $kategori->nama }}
        </label>
        <select class="form-select" name="barangs[]" id="barangs{{ $kategori->id }}">
          <option value="0" selected disabled>Pilih barang</option>
          @foreach ($kategori->barangs as $barang)
            <option value="{{ $barang->id }}" selected={{ old("barangs.{$loop->index}") == $barang->id }}>
              {{ $barang->nama }}</option>
          @endforeach
        </select>
      </div>
    @endforeach
    <div style="flex-basis: 100%; height: 0;"></div>
    <div style="flex-basis: 50%; height: 0;"></div>
    <button type="submit" class="btn btn-primary mt-4">Cek Kandungan</button>
  </form>

  @if (count($hasilInteraksis))
    <h5>Hasil Interaksi</h5>
    <div class="row w-100 mt-2">
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
                  <span class="fw-semibold">{{ $h->barang_satu }}</span> dan <span
                    class="fw-semibold">{{ $h->barang_dua }}</span>
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
  @endif
@endsection
