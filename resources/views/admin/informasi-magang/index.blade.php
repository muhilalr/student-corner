<x-layout-admin>
  <div class="content-wrapper">
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    {{-- Tabel Data Artikel --}}
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card" style="margin-top: 1rem;">
              <div class="card-header">
                <h3 class="card-title">Data Informasi Magang</h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="text-center">
                    <tr>
                      <th>Deskripsi</th>
                      <th>Persyaratan</th>
                      <th>Benefit</th>
                      <th>Info Kontak</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($info as $item)
                      <tr>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->persyaratan }}</td>
                        <td>{{ $item->benefit }}</td>
                        <td>{{ $item->info_kontak }}</td>
                        <td>
                          <div class="d-flex align-items-center justify-content-center" style="gap: 10px;">
                            <a href="{{ route('admin_informasi-magang.edit', $item->id) }}"
                              class="btn btn-warning"><span><i class="fas fa-edit"></i></span></a>
                            {{-- <form action="{{ route('admin_informasi-magang.destroy', $item->id) }}" method="POST"
                              class="m-0">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <span><i class="fas fa-trash"></i></span>
                              </button>
                            </form> --}}
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
    {{-- /.Tabel Data Artikel --}}
  </div>
</x-layout-admin>
