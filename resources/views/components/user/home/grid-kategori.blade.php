<div class="card mt-md-0 pt-md-0" style="margin-top: 22%">
  <div class="card-body">
    <h5 class="text-">Kategori</h5>
    <div class="grid">
      <div class="row row-cols-2 row-cols-md-4 justify-content-center">
        @foreach ($kategoris as $kategori)
          <div class="col p-0">
            <a href="{{ route('user.kategori.show', $kategori->id) }}"
              class="card bg-primary card-primary-hover text-decoration-none m-1 m-md-2">
              <div class="card-body d-flex justify-content-center align-items-center" style="height: 6rem">
                <h6 class="text-title text-white mb-0 text-center">
                  {{ $kategori->nama }}
                </h6>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
