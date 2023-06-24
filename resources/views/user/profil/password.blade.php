<div class="modal-header">
  <h5 class="modal-title">Ubah Password</h5>
</div>

<form class="modal-body" id="formProfil" action="{{ route('user.profil.update', $user->id) }}" method="POST">
  @csrf
  @method('PUT')

  <input type="hidden" name="aksi" value="password">
  <div class="mb-3">
    <label class="form-label" for="currentPassword">Password Saat Ini</label>
    <input type="password" class="form-control" name="currentPassword" placeholder="Password saat ini" required>
  </div>
  <div class="mb-3">
    <label class="form-label" for="password">Password Baru</label>
    <input type="password" minlength="8" class="form-control" name="password" placeholder="Password baru" required>
  </div>
  <div class="mb-3">
    <label class="form-label" for="confirm">Ulang Password Baru</label>
    <input type="password" minlength="8" class="form-control" name="confirm" placeholder="Ulang password" required>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Batal</button>
  <button type="submit" form="formProfil" class="btn btn-primary">Ubah</button>
</div>
