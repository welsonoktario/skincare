<div class="modal-header">
    <h5 class="modal-title">Detail Verifikasi Barang</h5>
      </button>

  </div>
  <div class="modal-body">
    <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">Nama Barang : </dt>
        <dd class="col-8">{{ $barangs->nama_barang }}</dd>
      </div>
    </div>
    <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">Harga : </dt>
        <dd class="col-8">{{ $barangs->harga}}</dd>
      </div>
    </div>
    <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">Stok : </dt>
        <dd class="col-8">{{ $barangs->stok }}</dd>
      </div>
    </div>
    <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">Deskripsi : </dt>
        <dd class="col-8">{{ $barangs->deskripsi }}</dd>
      </div>
    </div>
    {{-- <div class="mx-2 mb-3">
      <div class="row">
        <dt class="col-4">Foto Identitas (KTP,SIM,KK)</dt>
        <dd class="col-8">{{ $barangs->foto_identitas }}</dd>
        <td><img width="100%" src="{{ asset("storage/img/identitas/{$barangs->foto_identitas}") }}"></td>
      </div>
    </div> --}}
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">Tutup</button>
  </div>
