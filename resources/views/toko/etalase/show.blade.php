  <table class="table table-bordered w-100 mt-5">
    <thead>
      <tr>
        <th>No.</th>
        <th>Barang</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($etalases->barangs as $eb)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $eb->nama }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
