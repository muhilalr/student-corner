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
                <h3 class="card-title">Data Log Harian Magang <span>{{ $pendaftaran->nama }}</span>
                </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                  <form action="{{ route('admin_daftar-magang.index-admin') }}" method="GET" class="form-inline">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control mr-2"
                      placeholder="Cari Nama...">
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                  </form>
                </div>
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead class="text-center">
                      <tr>
                        <th>Tanggal</th>
                        <th>Uraian Kegiatan</th>
                        <th>Catatan</th>
                        <th>Status Kehadiran</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($logs as $log)
                        <tr>
                          <td>{{ \Carbon\Carbon::parse($log->tanggal)->format('d-m-Y') }}</td>
                          <td>{!! $log->uraian_kegiatan !!}</td>
                          <td>{!! $log->catatan !!}</td>
                          <td>
                            @if ($log->status_kehadiran == 'hadir')
                              <span class="badge badge-success">Hadir</span>
                            @elseif ($log->status_kehadiran == 'sakit')
                              <span class="badge badge-danger">Sakit</span>
                            @else
                              <span class="badge badge-warning">Izin</span>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $logs->links() }}
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
