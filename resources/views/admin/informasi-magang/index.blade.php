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
                <div class="mb-3 d-flex justify-content-between">
                  <form action="{{ route('admin_informasi-magang.index') }}" method="GET" class="form-inline">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control mr-2"
                      placeholder="Cari ...">
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                  </form>
                  <a href="{{ route('admin_informasi-magang.create') }}" class="btn btn-primary">
                    <span><i class="fas fa-plus mr-2"></i></span>Tambah Data
                  </a>
                </div>
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead class="text-center">
                      <tr>
                        <th>Nama Bidang</th>
                        <th>Posisi Magang</th>
                        <th>Jumlah yang Dibutuhkan</th>
                        <th>Deskripsi</th>
                        <th>Persyaratan</th>
                        <th>Benefit</th>
                        <th>Info Kontak</th>
                        <th>Ditambahkan Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($info as $item)
                        <tr>
                          <td>{{ $item->nama_bidang }}</td>
                          <td>{{ $item->posisi }}</td>
                          <td>{{ $item->kebutuhan_orang }} orang</td>
                          <td>{!! Str::limit($item->deskripsi, 50, '...') !!}</td>
                          <td>{!! Str::limit($item->persyaratan, 50, '...') !!}</td>
                          <td>{!! Str::limit($item->benefit, 50, '...') !!}</td>
                          <td>{!! Str::limit($item->info_kontak, 50, '...') !!}</td>
                          <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                          <td>
                            <div class="d-flex align-items-center justify-content-center" style="gap: 10px;">
                              @if ($item->status === 'aktif')
                                <!-- Jika sedang aktif, tampilkan tombol Nonaktifkan -->
                                <form action="{{ route('admin_informasi-magang.statusNonaktif', $item->id) }}"
                                  method="POST">
                                  @csrf
                                  <button type="submit" class="btn btn-secondary" title="Nonaktifkan Leaderboard">
                                    <i class="fas fa-times"></i> Nonaktifkan
                                  </button>
                                </form>
                              @else
                                <!-- Jika tidak aktif, tampilkan tombol Aktifkan -->
                                <form action="{{ route('admin_informasi-magang.statusAktif', $item->id) }}"
                                  method="POST">
                                  @csrf
                                  <button type="submit" class="btn btn-primary" title="Aktifkan">
                                    <i class="fas fa-check"></i> Aktifkan
                                  </button>
                                </form>
                              @endif
                            </div>
                          </td>
                          <td>
                            <div class="d-flex align-items-center justify-content-center" style="gap: 10px;">
                              <a href="{{ route('admin_informasi-magang.edit', $item->id) }}"
                                class="btn btn-warning"><span><i class="fas fa-edit"></i></span></a>
                              <form action="{{ route('admin_informasi-magang.destroy', $item->id) }}" method="POST"
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
