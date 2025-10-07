<x-layout-admin>
  <div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Stat Boxes -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $user }}</h3>
                <p>Pengguna</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $pendaftar_magang }}</h3>
                <p>Pendaftar Magang</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $pendaftar_riset }}</h3>
                <p>Pendaftar Kolaborasi Riset</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $artikel }}</h3>
                <p>Artikel</p>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $video }}</h3>
                <p>Video Pembelajaran</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ $infografis }}</h3>
                <p>Infografis</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-teal">
              <div class="inner">
                <h3>{{ $kuis_reguler }}</h3>
                <p>Kuis Reguler</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-indigo">
              <div class="inner">
                <h3>{{ $kuis_tantangan }}</h3>
                <p>Kuis Tantangan Bulanan</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Top Content Section -->
        <div class="row">
          <!-- Artikel Populer -->
          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-info text-white">
                <h3 class="card-title">Artikel Terpopuler</h3>
              </div>
              <div class="card-body">
                @if ($artikel_populer)
                  <p><strong>{{ $artikel_populer->judul }}</strong></p>
                  <p>Dilihat {{ $artikel_populer->total_dibaca }} kali</p>
                @else
                  <p>Belum ada data artikel populer.</p>
                @endif
              </div>
            </div>
          </div>

          <!-- Video Populer -->
          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-success text-white">
                <h3 class="card-title">Video Terpopuler</h3>
              </div>
              <div class="card-body">
                @if ($video_populer)
                  <p><strong>{{ $video_populer->judul }}</strong></p>
                  <p>Dibuka {{ $video_populer->total_dilihat }} kali</p>
                @else
                  <p>Belum ada data video populer.</p>
                @endif
              </div>
            </div>
          </div>

          <!-- Infografis Populer -->
          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-warning text-white">
                <h3 class="card-title">Infografis Terpopuler</h3>
              </div>
              <div class="card-body">
                @if ($infografis_populer)
                  <p><strong>{{ $infografis_populer->judul }}</strong></p>
                  <p>Dibuka {{ $infografis_populer->total_dilihat }} kali</p>
                @else
                  <p>Belum ada data infografis populer.</p>
                @endif
              </div>
            </div>
          </div>
        </div>

        <!-- Leaderboard Tantangan -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-dark text-white">
                <h3 class="card-title">Leaderboard Periode {{ $periode->periode }}</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-center">
                  <thead>
                    <tr>
                      <th>Peringkat</th>
                      <th>Nama Pengguna</th>
                      <th>Skor</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($top_users as $index => $user)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->user->name }}</td>
                        <td>{{ $user->total_skor }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4">Belum ada data leaderboard.</td>
                      </tr>
                    @endforelse

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>
</x-layout-admin>
