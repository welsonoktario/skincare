<div class="modal-header">
  <h5 class="modal-title">Berikan Ulasan</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#modalDetail" aria-label="Close"></button>
</div>

<form id="formUlasan" class="modal-body" action="{{ route('user.transaksi.update', $transaksi->id) }}" method="POST">
  @csrf
  @method('PUT')

  <input type="text" name="ulasan" class="d-none">
  @foreach ($transaksi->transaksiDetails as $td)
    <input class="d-none" type="number" name="ratings[{{ $td->id }}]" id="ratings-{{ $td->id }}">
    <div @class(['mb-5' => !$loop->last])>
      <h6>{{ $td->barang->nama }}</h6>
      <p class="mb-1" for="ratings[{{ $td->id }}]">Rating</p>
      <div class="selectgroup text-warning">
        @for ($i = 1; $i <= 5; $i++)
          <label class="btn-rating selectgroup-item" for="{{ $i }}" data-rating="ratings-{{ $td->id }}">
            <input id="ratings-{{ $td->id }}-{{ $i }}" class="selectgroup-input" type="radio" name="ratings[]" value="{{ $i }}">
            <span class="selectgroup-button border-0 selectgroup-button-icon">
              <i class="far fa-star ratings-{{ $td->id }}-{{ $i }}"></i>
            </span>
          </label>
        @endfor
      </div>

      <div>
        <label for="komentars[{{ $td->id }}]" class="form-label">Komentar</label>
        <textarea class="form-control h-100" rows="3" name="komentars[{{ $td->id }}]" placeholder="Komentar tambahan"></textarea>
      </div>
    </div>
  @endforeach
</form>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#modalDetail">
    Tutup
  </button>
  <button form="formUlasan" type="submit" class="btn btn-primary" data-bs-target="#modalDetail">
    Tambah
  </button>
</div>
