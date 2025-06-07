<x-layout-admin>
  <div class="content-wrapper">
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Tabel Data Sub Judul Artikel --}}
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card" style="margin-top: 1rem;">
              <div class="card-header">
                <h3 class="card-title">Data Sub Judul Artikel</h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <div class="mb-3 d-flex justify-content-end"><a href="{{ route('admin_subjudul-artikel.create') }}"
                    class="btn btn-primary"><span><i class="fas fa-plus mr-2"></i></span>Tambah Data</a>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="text-center">
                    <tr>
                      <th>Judul Artikel</th>
                      <th>Sub Judul Artikel</th>
                      <th>Urutan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($subjuduls as $item)
                      <tr>
                        <td>{{ $item->artikel->judul }}</td>
                        <td>{{ $item->sub_judul }}</td>
                        <td>{{ $item->urutan }}</td>
                        <td>
                          <div class="d-flex align-items-center justify-content-center" style="gap: 10px;">
                            <a href="{{ route('admin_subjudul-artikel.edit', $item->id) }}"
                              class="btn btn-warning"><span><i class="fas fa-edit"></i></span></a>
                            <form action="{{ route('admin_subjudul-artikel.destroy', $item->id) }}" method="POST"
                              class="m-0">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <span><i class="fas fa-trash"></i></span>
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    {{-- /.Tabel Data Sub Judul Artikel --}}
  </div>
</x-layout-admin>
