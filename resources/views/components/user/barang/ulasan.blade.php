<div>
  <p class="text-black fw-medium mb-0">
    {{ $ulasan->user->nama }}
  </p>
  <p>
    @for ($i = 1; $i <= $ulasan->rating; $i++)
      <i class="fas fa-star text-primary"></i>
    @endfor
  </p>
  @if ($ulasan->komentar)
    <p class="mb-0 text-black">
      {{ $ulasan->komentar }}
    </p>
  @endif
</div>
