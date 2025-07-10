<x-layout-admin>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Topik Kuis Reguler</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <form method="POST" action="{{ route('admin_kuis-reguler.update', $kuis_reguler->id) }}"
                enctype="multipart/form-data">

                <div class="card-body">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="judul_kuis">Judul Kuis Reguler</label>
                    <input type="text" name="judul" class="form-control" id="judul_kuis"
                      value="{{ $kuis_reguler->judul }}" placeholder="Masukkan Judul Kuis" required>
                  </div>
                  <div class="form-group">
                    <label for="deskripsi_kuis">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" id="deskripsi_kuis"
                      value="{{ $kuis_reguler->deskripsi }}" placeholder="Masukkan Deskripsi Kuis" required>
                  </div>
                  <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar" class="form-control" id="gambar"
                      placeholder="Masukkan Gambar Kuis">
                  </div>
                  <div class="form-group">
                    <label for="durasi_menit">Durasi Pengerjaan (menit)</label>
                    <input type="number" name="durasi_menit" id="durasi_menit" class="form-control"
                      value="{{ $kuis_reguler->durasi_menit }}" required placeholder="Masukkan Durasi Pengerjaan">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</x-layout-admin>
