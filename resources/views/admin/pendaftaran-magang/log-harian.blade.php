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
            @if ($verifikasi->count() > 0)
              <div class="card" style="margin-top: 1rem;">
                <div class="card-header">
                  <h3 class="card-title">Log Harian Magang <span>{{ $pendaftaran->nama }}</span> Yang Harus Diverifikasi
                  </h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="text-center">
                        <tr>
                          <th>Tanggal</th>
                          <th>Uraian Kegiatan</th>
                          <th>Catatan</th>
                          <th>Status Kehadiran</th>
                          <th>Status Verifikasi</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($verifikasi as $log)
                          <tr>
                            <td>{{ \Carbon\Carbon::parse($log->tanggal)->format('d-m-Y') }}</td>
                            <td>{!! $log->uraian_kegiatan !!}</td>
                            <td>
                              @if ($log->catatan)
                                {!! $log->catatan !!}
                              @else
                                -
                              @endif
                            </td>
                            <td class="text-center">
                              @if ($log->status_kehadiran == 'hadir')
                                <span class="badge badge-success">Hadir</span>
                              @elseif ($log->status_kehadiran == 'sakit')
                                <span class="badge badge-danger">Sakit</span>
                              @else
                                <span class="badge badge-warning">Izin</span>
                              @endif
                            </td>
                            <td class="text-center">
                              @if ($log->status_verifikasi == 'disetujui')
                                <span class="badge badge-success">Disetuji</span>
                              @elseif ($log->status_kehadiran == 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                              @else
                                <span class="badge badge-warning">Menunggu</span>
                              @endif
                            </td>
                            <td>
                              <div class="d-flex align-items-center justify-content-center" style="gap: 10px;">
                                <form action="{{ route('admin_daftar-magang.verifikasiSetuju', $log->id) }}"
                                  method="POST">
                                  @csrf
                                  <button type="submit" class="btn btn-primary" title="Verifikasi Setuju">
                                    <i class="fas fa-check"></i>
                                  </button>
                                </form>
                                <form action="{{ route('admin_daftar-magang.verifikasiTolak', $log->id) }}"
                                  method="POST">
                                  @csrf
                                  <button type="submit" class="btn btn-danger" title="Verifikasi Tolak">
                                    <i class="fas fa-times"></i>
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
            @endif
            <div class="card" style="margin-top: 1rem;">
              <div class="card-header">
                <h3 class="card-title">Data Log Harian Magang <span>{{ $pendaftaran->nama }}</span>
                </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
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
                          <td class="text-center">
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
