<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('template/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        {{-- <a href="#" class="d-block">{{ Session::get('ambilUser')->nama }}</a> --}}
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
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
                <p>Topik Kuis Reguler</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin_soal-kuis-tantangan-bulanan.index') }}"
                class="nav-link {{ Route::is('admin_soal-kuis-tantangan-bulanan.index') ? 'active' : '' }}">
                <p>Soal Kuis Tamtangan Bulanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin_opsi-pilgan-tantangan-bulanan.index') }}"
                class="nav-link {{ Route::is('admin_opsi-pilgan-tantangan-bulanan.index') ? 'active' : '' }}">
                <p>Opsi Soal Pilihan Ganda</p>
              </a>
            </li>
          </ul>
        </li>


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
