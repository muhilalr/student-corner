<x-layout-admin>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Input Video Pembelajaran</h3>
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
          <form method="POST" action="{{ route('admin_video-pembelajaran.store') }}">
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
                <label for="judul_video">Judul Video</label>
                <input type="text" name="judul" class="form-control" id="judul_video"
                  placeholder="Masukkan Judul Video" required>
              </div>
              <div class="form-group">
                <label for="deskripsi_video">Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control" id="deskripsi_video"
                  placeholder="Masukkan Deskripsi Video" required>
              </div>
              <div class="form-group">
                <label for="link">Link Video</label>
                <input type="text" name="link" class="form-control" id="link"
                  placeholder="Masukkan Link Video" required>
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
