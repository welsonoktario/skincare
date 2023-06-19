@extends('layouts.toko')
@section('content')
  <div class="container-fluid">
    <h3 class="my-4 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">
      Ekspedisi
    </h3>

    <div class="card">
      <form class="card-body" action="{{ route('toko.ekspedisi.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
          <div class="control-label">Pengaturan Jasa Pengiriman</div>
          <div class="custom-switches-stacked mt-2">
            @foreach ($ekspedisis as $ekspedisi)
              @php
                $checked = $tokoEkspedisis->contains('id', $ekspedisi->id);
              @endphp
              <label class="custom-switch">
                <input type="checkbox" name="ekspedisis[]" value="{{ $ekspedisi->id }}" class="custom-switch-input"
                  @if ($checked) checked @endif>
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description text-uppercase">{{ $ekspedisi->nama }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
@endsection
