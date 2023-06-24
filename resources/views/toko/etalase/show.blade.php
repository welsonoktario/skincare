<div class="modal-header">
  <h5 class="modal-title">Detail Etalase</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  <p class="mb-0">Nama Etalase</p>
  <p class="text-dark fw-semibold">{{ $etalases->nama }}</p>

  <div class="table-responsive">
    <table class="table table-bordered w-100">
      <thead>
        <tr>
          <th>No.</th>
          <th>Barang</th>
        </tr>
      </thead>
      <tbody>
        @if (count($etalases->barangs))
          @foreach ($etalases->barangs as $eb)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $eb->nama }}</td>
            </tr>
          @endforeach
        @else
          <tr>
            <td class="text-center" colspan="2">Belum ada barang</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Tutup</button>
</div>
