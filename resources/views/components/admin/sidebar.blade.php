<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel pt-3 d-flex justify-content-center align-items-center">
      <img src="{{ asset('/gambar/logo-bps.jpg') }}" alt="" class="w-25">
      <h6 class="font-weight-bold text-white">BPS PROVINSI <br>KEP. BANGKA BELITUNG</h6>
      {{-- <a href="#" class="d-block">{{ Session::get('ambilUser')->nama }}</a> --}}
    </div>
    <div class="user-panel pt-3 d-flex justify-content-center align-items-center">
      @role('admin')
        <h2 class="font-weight-bold text-white">Admin</h2>
      @endrole
      @role('operator')
        <h2 class="font-weight-bold text-white">Operator</h2>
      @endrole
      @role('operator magang')
        <h4 class="font-weight-bold text-white">Operator Magang</h4>
      @endrole
      {{-- <a href="#" class="d-block">{{ Session::get('ambilUser')->nama }}</a> --}}
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        @role('admin')
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <p>
                Konten Edukasi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin_subjek-materi.index') }}"
                  class="nav-link {{ Route::is('admin_subjek-materi.index') ? 'active' : '' }}">
                  <p>Data Subjek Materi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_artikel.index') }}"
                  class="nav-link {{ Route::is('admin_artikel.index') ? 'active' : '' }}">
                  <p>Data Artikel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_subjudul-artikel.index') }}"
                  class="nav-link {{ Route::is('admin_subjudul-artikel.index') ? 'active' : '' }}">
                  <p>Data Sub Judul Artikel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_detail-subjudul-artikel.index') }}"
                  class="nav-link {{ Route::is('admin_detail-subjudul-artikel.index') ? 'active' : '' }}">
                  <p>Data Detail Sub Judul Artikel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_video-pembelajaran.index') }}"
                  class="nav-link {{ Route::is('admin_video-pembelajaran.index') ? 'active' : '' }}">
                  <p>Data Video Pembelajaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_infografis.index') }}"
                  class="nav-link {{ Route::is('admin_infografis.index') ? 'active' : '' }}">
                  <p>Data Infografis</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <p>
                Informasi Magang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin_informasi-magang.index') }}"
                  class="nav-link {{ Route::is('admin_informasi-magang.index') ? 'active' : '' }}">
                  <p>Informasi Magang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_daftar-magang.index-admin') }}"
                  class="nav-link {{ Route::is('admin_daftar-magang.index-admin') ? 'active' : '' }}">
                  <p>Data Pendaftar Magang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_daftar-magang.magangDiterima') }}"
                  class="nav-link {{ Route::is('admin_daftar-magang.magangDiterima') ? 'active' : '' }}">
                  <p>Pendaftar Magang Diterima</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_daftar-magang.magangDitolak') }}"
                  class="nav-link {{ Route::is('admin_daftar-magang.magangDitolak') ? 'active' : '' }}">
                  <p>Pendaftar Magang Ditolak</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_daftar-magang.riwayatMagang') }}"
                  class="nav-link {{ Route::is('admin_daftar-magang.riwayatMagang') ? 'active' : '' }}">
                  <p>Riwayat Pendaftar Magang</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <p>
                Kuis Reguler
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin_kuis-reguler.index') }}"
                  class="nav-link {{ Route::is('admin_kuis-reguler.index') ? 'active' : '' }}">
                  <p>Topik Kuis Reguler</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_soal-kuis-reguler.index') }}"
                  class="nav-link {{ Route::is('admin_soal-kuis-reguler.index') ? 'active' : '' }}">
                  <p>Soal Kuis Reguler</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_opsi-soal-pilihan-ganda.index') }}"
                  class="nav-link {{ Route::is('admin_opsi-soal-pilihan-ganda.index') ? 'active' : '' }}">
                  <p>Opsi Soal Pilihan Ganda</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <p>
                Kuis Tantangan Bulanan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin_periode.index') }}"
                  class="nav-link {{ Route::is('admin_periode.index') ? 'active' : '' }}">
                  <p>Periode Kuis Tantangan Bulanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_kuis-tantangan-bulanan.index') }}"
                  class="nav-link {{ Route::is('admin_kuis-tantangan-bulanan.index') ? 'active' : '' }}">
                  <p>Topik Kuis Tantangan Bulanan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin_data-admin.index') }}" class="nav-link">
              <p>
                Manajemen User
              </p>
            </a>
          </li>
        @endrole

        @role('operator')
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <p>
                Konten Edukasi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin_subjek-materi.index') }}"
                  class="nav-link {{ Route::is('admin_subjek-materi.index') ? 'active' : '' }}">
                  <p>Data Subjek Materi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_artikel.index') }}"
                  class="nav-link {{ Route::is('admin_artikel.index') ? 'active' : '' }}">
                  <p>Data Artikel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_subjudul-artikel.index') }}"
                  class="nav-link {{ Route::is('admin_subjudul-artikel.index') ? 'active' : '' }}">
                  <p>Data Sub Judul Artikel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_detail-subjudul-artikel.index') }}"
                  class="nav-link {{ Route::is('admin_detail-subjudul-artikel.index') ? 'active' : '' }}">
                  <p>Data Detail Sub Judul Artikel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_video-pembelajaran.index') }}"
                  class="nav-link {{ Route::is('admin_video-pembelajaran.index') ? 'active' : '' }}">
                  <p>Data Video Pembelajaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_infografis.index') }}"
                  class="nav-link {{ Route::is('admin_infografis.index') ? 'active' : '' }}">
                  <p>Data Infografis</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <p>
                Kuis Reguler
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin_kuis-reguler.index') }}"
                  class="nav-link {{ Route::is('admin_kuis-reguler.index') ? 'active' : '' }}">
                  <p>Topik Kuis Reguler</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_soal-kuis-reguler.index') }}"
                  class="nav-link {{ Route::is('admin_soal-kuis-reguler.index') ? 'active' : '' }}">
                  <p>Soal Kuis Reguler</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_opsi-soal-pilihan-ganda.index') }}"
                  class="nav-link {{ Route::is('admin_opsi-soal-pilihan-ganda.index') ? 'active' : '' }}">
                  <p>Opsi Soal Pilihan Ganda</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <p>
                Kuis Tantangan Bulanan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin_kuis-tantangan-bulanan.index') }}"
                  class="nav-link {{ Route::is('admin_kuis-tantangan-bulanan.index') ? 'active' : '' }}">
                  <p>Topik Kuis Tantangan Bulanan</p>
                </a>
              </li>
            </ul>
          </li>
        @endrole

        @role('operator magang')
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <p>
                Informasi Magang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin_informasi-magang.index') }}"
                  class="nav-link {{ Route::is('admin_informasi-magang.index') ? 'active' : '' }}">
                  <p>Informasi Magang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin_daftar-magang.index-admin') }}"
                  class="nav-link {{ Route::is('admin_daftar-magang.index-admin') ? 'active' : '' }}">
                  <p>Data Pendaftar Magang</p>
                </a>
              </li>
            </ul>
          </li>
        @endrole

        <li class="nav-item">
          <a href="{{ route('admin_logout') }}" class="nav-link">
            <p>
              Log Out
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
