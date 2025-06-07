<x-layout-admin>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Input Artikel</h3>
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
          <form method="POST" action="{{ route('admin_artikel.store') }}" enctype="multipart/form-data">
            <div class="card-body">
              @csrf
              <div class="form-group">
                <label for="subjek_materi">Subjek Materi</label>
                <select name="subjek_materi" class="form-control" required>
                  <option value="" disabled selected>-- Pilih Subjek --</option>
                  @foreach ($subjek_materi as $subjek)
                    <option value="{{ $subjek->id }}">{{ $subjek->judul }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="judul_artikel">Judul Artikel</label>
                <input type="text" name="judul" class="form-control" id="judul_artikel"
                  placeholder="Masukkan Judul Artikel" required>
              </div>
              <div class="form-group">
                <label for="deskripsi_artikel">Deskripsi Artikel</label>
                <input type="text" name="deskripsi" class="form-control" id="deskripsi_artikel"
                  placeholder="Masukkan Deskripsi Artikel" required>
              </div>
              <div class="form-group">
                <label for="gambar">Gambar Artikel</label>
                <input type="file" name="gambar" class="form-control" id="gambar"
                  placeholder="Masukkan Gambar Artikel" required>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
</x-layout-admin>
