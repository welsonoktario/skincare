<form id="formTopup" action="{{ route('user.topup.update', $topup->id) }}" method="POST" enctype="multipart/form-data">
  @method('PUT')
  @csrf
  <div class="modal-header">
    <h5 class="modal-title">Tambah Saldo</h5>
  </div>
  <div class="modal-body">
    <div class="form-group">
      <p class="mb-0">Nominal: <span class="text-primary">@rupiah($topup->nominal)</span></p>
      <p>Total pembayaran: @rupiah($topup->nominal)</p>
      <label class="control-label" for="nominal">Foto Bukti Pembayaran</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*">
        <label class="custom-file-label" for="bukti_pembayaran">Pilih foto</label>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button form="formTopup" type="submit" class="btn btn-primary">Tambah</button>
  </div>
</form>
