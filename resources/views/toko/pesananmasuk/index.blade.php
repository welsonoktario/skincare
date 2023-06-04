@extends('layouts.toko')
@section('content')
<div class="container-fluid">
  <p class="h3 my-4 text-gray-800 d-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Pesanan Masuk</p>
  <form id="form-aksi" method="POST">
    @csrf
    @method('PUT')
    <input id="aksi" type="hidden" name="aksi">
    <input id="customer" type="hidden" name="customer">
    @forelse ($pesananmasuk as $data)
      <div class="card w-100">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <p class="card-text">Id Transaksi : {{ $data->id }}</p>
            </div>
          </div>
          <div class="row">
            {{-- <p class="col-sm-2">Tanggal Order</p> --}}
            <div class="col-sm-10">
              <p class="card-text">Tanggal Order : {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s') }}</p>
            </div>
          </div>
          <div class="row">
            {{-- <p class="col-sm-2">Total Harga</p> --}}
            <div class="col-sm-10">
              <p class="card-text">Total Harga : {{ $data->total_harga }}</p>
            </div>
          </div>
          <div class="row">
            <div class="d-inline-flex justify-content-between">
              @if ($data->status == 'pending')
                <div><button class="btn btn-aksi btn-primary text-white" data-transaksi="{{ $data->id }}"
                    data-aksi="diproses" data-customer="{{ $data->user->id }}" type="submit">Konfirmasi</button>
                  <button class="btn btn-aksi btn-secondary text-dark" data-transaksi="{{ $data->id }}"
                    data-aksi="batal" data-customer="{{ $data->user->id }}" type="submit">Tolak</button>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      <hr>
    @empty
     TIDAK ADA PESANAN MASUK
    @endforelse
  </form>
</div>
@endsection
@push('scripts')
  <script>
    $(function() {
      $('.btn-aksi').click(function(e) {
        e.preventDefault();
        const {
          transaksi,
          customer,
          aksi
        } = $(this).data();

        $('#aksi').val(aksi);
        $('#customer').val(customer);

        $('#form-aksi').prop('action',  '/toko/pesananmasuk/'+transaksi);
        $('#form-aksi').submit();
      });
    });
  </script>
@endpush

