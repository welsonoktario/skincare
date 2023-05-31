@extends('user.profil.profil')
@section('title', 'Daftar Alamat • Skincare')
@section('profil-content')
  <div class="d-flex flex-row justify-content-between align-items-center">
    <h6 class="m-0 text-dark">Daftar Alamat</h6>
    <button class="btn btn-modal btn-primary float-end" data-action="add">
      Tambah Alamat
    </button>
  </div>

  <div class="mt-4">
    @forelse ($alamats as $alamat)
      <div class="card {{ $alamat->is_utama ? 'bg-primary' : '' }}" data-alamat="{{ $alamat }}"
        style="border: 1px solid var(--primary);">
        <div class="card-body">
          @if ($alamat->is_utama)
            <div class="d-inline-flex w-100 justify-content-between align-items-center">
              <h6 class="mb-0">{{ $alamat->nama }}</h6>
              <span class="badge rounded-pill text-bg-light">Terpilih</>
            </div>
          @else
            <h6 class="mb-0 text-dark">{{ $alamat->nama }}</h6>
          @endif
          <p>{{ $alamat->alamat }}, {{ $alamat->kota->nama }}, {{ $alamat->provinsi->nama }}</p>
          <p class="mb-0">{{ $alamat->penerima }} ({{ $alamat->kontak }})</p>
        </div>
        <div class="card-footer text-end">
          @if (!$alamat->is_utama)
            <div class="d-inline-flex align-items-center" style="column-gap: 0.5rem">
              <form action="{{ route('user.user.alamat.setUtama', $alamat->id) }}" method="post">
                @csrf
                @method('PATCH')
                <button class="btn btn-primary">Jadikan Utama</button>
              </form>
              <a class="btn-modal btn btn-secondary" data-action="edit" role="button">
                Edit
              </a>
              <a class="btn-hapus btn btn-danger" role="button" data-id="{{ $alamat->id }}">
                Hapus
              </a>
            </div>
          @else
            <a class="btn-modal btn btn-secondary shadow-none text-dark" role="button" data-action="edit">
              Edit
            </a>
          @endif
        </div>
      </div>
    @empty
      <div class="empty-state text-center" data-height="400" style="height: 400px;">
        <div class="empty-state-icon">
          <i class="fas fa-question"></i>
        </div>
        <h2>Belum ada alamat</h2>
        <p class="lead">
          Anda belum memiliki data alamat
        </p>
        <button class="btn btn-modal btn-primary float-end" data-action="add">
          Tambah Alamat Baru
        </button>
      </div>
    @endforelse
  </div>

  <div id="modalAlamat" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-dark">
          <h1 id="modalAlamatTitle" class="modal-title fs-5"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formAlamat" class="modal-body" method="POST">
          @csrf
          <div class="form-group">
            <label for="nama">Nama</label>
            <input name="nama" type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input name="alamat" type="street-address" autocomplete="street-address" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="provinsi">Provinsi</label>
            <select class="form-control form-select" name="provinsi" required>
              <option value="0" selected disabled>Pilih provinsi</option>
              @foreach ($provinsis as $provinsi)
                <option value="{{ $provinsi->id }}">{{ $provinsi->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="kota">Kota</label>
            <select class="form-control form-select" name="kota" disabled required>
              <option value="0" selected disabled>Pilih kota</option>
            </select>
          </div>
          <div class="form-group">
            <label for="penerima">Nama Penerima</label>
            <input name="penerima" type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="kontak">Kontak Penerima</label>
            <input name="kontak" type="tel" class="form-control" required>
          </div>
          <div class="form-group">
            <input type="checkbox" name="isUtama" class="form-check-input">
            <label class="form-check-label" for="isUtama">
              Jadikan alamat utama
            </label>
          </div>
        </form>
        <div class="modal-footer text-right">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
            Batal
          </button>
          <button type="submit" form="formAlamat" class="btn btn-primary">
            Simpan
          </button>
        </div>
      </div>
    </div>
  </div>

  <div id="modalDelete" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-dark">
          <h1 class="modal-title fs-5">Hapus Alamat</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formDelete" class="modal-body" method="POST">
          @method('DELETE')
          @csrf
          <p>Apakah anda yakin ingin menghapus data alamat ini?</p>
        </form>
        <div class="modal-footer text-end">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" form="formDelete" class="btn btn-danger">Hapus</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(function() {
      let modalAlamat = $('#modalAlamat');
      let modalDelete = $('#modalDelete');
      let selectProvinsi = $('select[name="provinsi"]');
      let selectKota = $('select[name="kota"]');
      let formDelete = $('#formDelete');

      $('.btn-modal').click(function() {
        let formAlamat = $('#formAlamat');
        let action = $(this).data('action');

        if (action == 'add') {
          $('#modalAlamatTitle').text('Tambah Alamat');
          formAlamat.prop('action', route('user.profil.alamat.store'));
          formAlamat.trigger('reset');
          selectKota.prop('disabled', true);
          selectKota.val('0');
          selectKota.find('option')
            .not(':first')
            .remove();

          if ($('input[name="_method"]').length) {
            $('input[name="_method"]').remove();
          }
        } else if (action == 'edit') {
          $('#modalAlamatTitle').text('Edit Alamat');
          loadAlamat($(this));

          if (!$('#formAlamat input[name="_method"]').length) {
            formAlamat.prepend('<input type="hidden" name="_method" value="PUT">');
          }
        }

        modalAlamat.modal('show');
      });

      $('.btn-hapus').click(function() {
        let id = $(this).data('id');
        let url = route('user.profil.alamat.destroy', {
          alamat: id
        });

        formDelete.prop('action', url);
        modalDelete.modal('show');
      });

      selectProvinsi.change(function() {
        selectKota.prop('disabled', true);
        selectKota.val('0');
        selectKota.find('option')
          .not(':first')
          .remove();

        let id = $(this).val();

        fetch(route('user.checkout.loadKota', {
            provinsi: id
          }))
          .then(res => res.json())
          .then(data => {
            data.forEach(kota => {
              let opt = `<option value="${kota.id}">${kota.nama}</option>`;
              selectKota.append(opt);
            });
          })
          .finally(() => selectKota.prop('disabled', false));
      });

      function loadAlamat(el) {
        let formAlamat = $('#formAlamat');
        let alamat = el.closest('.card').data('alamat');

        formAlamat.prop('action', route('user.profil.alamat.update', alamat.id));
        $('input[name="nama"]').val(alamat.nama);
        $('input[name="alamat"]').val(alamat.alamat);
        $('input[name="penerima"]').val(alamat.penerima);
        $('input[name="kontak"]').val(alamat.kontak);
        $('select[name="provinsi"]').val(alamat.provinsi_id);
        $('input[name="isUtama"]').prop('checked', alamat.is_utama);

        fetch(route('user.checkout.loadKota', {
            provinsi: alamat.provinsi_id
          }))
          .then(res => res.json())
          .then(data => {
            data.forEach(kota => {
              let opt;

              if (kota.id == alamat.kota_id) {
                opt = `<option value="${kota.id}" selected>${kota.nama}</option>`;
              } else {
                opt = `<option value="${kota.id}">${kota.nama}</option>`;
              }

              selectKota.append(opt);
            });
          })
          .finally(() => selectKota.prop('disabled', false));
      }
    });
  </script>
@endpush
