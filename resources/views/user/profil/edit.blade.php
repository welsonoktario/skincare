<div class="modal-header">
  <h5 class="modal-title">Ubah Profil</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form class="modal-body" id="formProfil" action="{{ route('user.profil.update', $user->id) }}" method="POST">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label class="form-label" for="nama">Nama</label>
    <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{ $user->nama }}" required>
  </div>
  <div class="mb-3">
    <label class="form-label" for="username">Username</label>
    <input type="text" class="form-control" name="username" placeholder="Username" value="{{ $user->username }}"
      required>
  </div>
  <div class="mb-3">
    <label class="form-label" for="email">Email</label>
    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}" required>
  </div>
  <div class="mb-3">
    <label class="form-label" for="hp">No. HP</label>
    <input type="tel" class="form-control" name="hp" placeholder="No. HP" value="{{ $user->no_hp }}" required>
  </div>
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Batal</button>
  <button type="submit" form="formProfil" class="btn btn-primary">Ubah</button>
</div>
