@extends('layouts.app')
@section('title', 'Cek Interaksi Zat Aktif • Skincareku')
@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item">Keranjang</li>
    </ol>
  </nav>

  <h4>Cek Interaksi Zat Aktif</h4>

  <div class="card">
    <form id="formCek" action="{{ route('user.cek-kandungan.cek') }}" class="card-body" style="column-gap: 1rem;"
      method="POST">
      @csrf
      <div class="row align-items-center">
        <div id="img1" class="col-3">
          <div class="d-none text-center">
            <img class="mb-2" src="" alt="" width="50%">
            <h6 class="mb-0 fw-semibold"></h6>
          </div>
        </div>

        <div class="col-3">
          <label for="barangs[]" class="form-label">
            Barang 1
          </label>
          <select id="barang1" class="form-select" name="barangs[]">
            <option value="0" selected disabled>Pilih barang</option>
            @foreach ($barangs as $barang)
              <option value="{{ $barang->id }}" @if (old('barangs.0') == $barang->id) selected @endif>
                {{ $barang->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-3">
          <label for="barangs[]" class="form-label">
            Barang 2
          </label>
          <select id="barang2" class="form-select" name="barangs[]">
            <option value="0" selected disabled>Pilih barang</option>
            @foreach ($barangs as $barang)
              <option value="{{ $barang->id }}" @if (old('barangs.1') == $barang->id) selected @endif>
                {{ $barang->nama }}
              </option>
            @endforeach
          </select>
        </div>

        <div id="img2" class="col-3">
          <div class="d-none text-center">
            <img class="mb-3" src="" alt="" width="50%">
            <h6 class="mb-0 fw-semibold"></h6>
          </div>
        </div>

        <div class="col-5"></div>
        <button id="btnCek" type="submit" class="col-2 btn btn-primary mt-4">Cek Interaksi</button>
        <div class="col-5"></div>
      </div>
    </form>
  </div>

  @if (count($hasilInteraksis))
    <h5>Hasil Interaksi</h5>
    <div class="card">
      <div class="card-header">
        <h6 class="card-title mb-0">
          Hasil Pengecekan Zat Aktif {{ $namaBarangs[0] }} dan {{ $namaBarangs[1] }}
        </h6>
      </div>
      <div class="card-body row w-100 mt-2">
        @foreach ($hasilInteraksis as $jenis => $hasil)
          <div class="col-4">
            <h6 class="text-capitalize mt-2 mb-1">Interaksi {{ $jenis }}</h6>
            <ul class="list-group">
              @foreach ($hasil as $h)
                <li @class([
                    'list-group-item alert text-dark border',
                    'border-success' => $h->jenis_interaksi == 'baik',
                    'border-danger' => $h->jenis_interaksi == 'buruk',
                ])>
                  <div @class([
                      'alert-title text-capitalize',
                      'text-success' => $h->jenis_interaksi == 'baik',
                      'text-danger' => $h->jenis_interaksi == 'buruk',
                  ])>
                    Interaksi {{ $h->jenis_interaksi }}
                  </div>
                  <p class="mb-2" style="line-height: 1.2">
                    <span @class([
                        'fw-semibold',
                        'text-success' => $h->jenis_interaksi == 'baik',
                        'text-danger' => $h->jenis_interaksi == 'buruk',
                    ])>
                      {{ $h->barang_satu }}
                    </span>
                    dengan zat aktif
                    <span @class([
                        'fw-semibold',
                        'text-success' => $h->jenis_interaksi == 'baik',
                        'text-danger' => $h->jenis_interaksi == 'buruk',
                    ])>
                      {{ $h->kandungan_satu }}
                    </span>
                    dan
                    <span @class([
                        'fw-semibold',
                        'text-success' => $h->jenis_interaksi == 'baik',
                        'text-danger' => $h->jenis_interaksi == 'buruk',
                    ])>
                      {{ $h->barang_dua }}
                    </span>
                    dengan zat aktif
                    <span @class([
                        'fw-semibold',
                        'text-success' => $h->jenis_interaksi == 'baik',
                        'text-danger' => $h->jenis_interaksi == 'buruk',
                    ])>
                      {{ $h->kandungan_dua }}
                    </span>
                  </p>
                  <p class="fw-light" style="line-height: 1.2">{{ $h->deskripsi_interaksi }}</p>
                  <p class="mb-0 mt-1 text-small fst-italic text-black-50">Sumber: {{ $h->sumber }}</p>
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
      $('#barang1').change(function() {
        var id = $(this).val();

        $.get(route('user.cek-kandungan.show', id), function(data) {
          $('#img1 div').removeClass('d-none');
          $('#img1 img').prop('src', `/storage/${data.foto}`);
          $('#img1 h6').text(data.nama);
        });
      });

      $('#barang2').change(function() {
        var id = $(this).val();

        $.get(route('user.cek-kandungan.show', id), function(data) {
          $('#img2 div').removeClass('d-none');
          $('#img2 img').prop('src', `/storage/${data.foto}`);
          $('#img2 h6').text(data.nama);
        });
      });

      $('#btnCek').click(function(e) {
        e.preventDefault();
        var [barang1, barang2] = $('select[name="barangs[]').map((i, e) => e.value).get();

        if (barang1 == '0' || barang2 == '0') {
          alert('Pilih barang satu dan barang dua');
          return
        }

        if (barang1 == barang2) {
          alert('Barang tidak boleh sama');
          return
        }

        $('#formCek').submit();
      });
    });
  </script>
@endpush
