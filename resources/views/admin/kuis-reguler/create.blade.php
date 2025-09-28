<x-layout-admin>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Input Topik Kuis Reguler</h3>
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
          <form method="POST" action="{{ route('admin_kuis-reguler.store') }}" enctype="multipart/form-data">
            <div class="card-body">
              @csrf
              <div class="form-group">
                <label for="judul_kuis">Judul Kuis Reguler</label>
                <input type="text" name="judul" class="form-control" id="judul_kuis"
                  placeholder="Masukkan Judul Kuis" required>
              </div>
              <div class="form-group">
                <label for="soal">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="editor" placeholder="Masukkan Deskripsi Kuis" cols="30"
                  rows="10"></textarea>
              </div>
              <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" class="form-control" id="gambar"
                  placeholder="Masukkan Gambar Kuis" accept="image/jpg, image/jpeg, image/png" required>
              </div>
              <div class="form-group">
                <label for="durasi_menit">Durasi Pengerjaan (menit)</label>
                <input type="number" name="durasi_menit" id="durasi_menit" class="form-control" required
                  placeholder="Masukkan Durasi Pengerjaan">
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
  <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@35.3.0/build/ckeditor.js"></script>
  <script>
    const editors = ['editor'];
    editors.forEach(id => {
      ClassicEditor
        .create(document.querySelector(`#${id}`), {
          toolbar: [
            'heading', '|',
            'bold', 'italic', 'underline', 'strikethrough', '|',
            'fontColor', 'fontSize', '|',
            'link', 'bulletedList', 'numberedList', '|',
            'alignment',
            'insertTable', '|',
            'undo', 'redo'
          ],
          fontSize: {
            options: [9, 11, 13, 'default', 17, 19, 21],
            supportAllValues: false
          },
          fontColor: {
            columns: 5,
            documentColors: 5
          }
        })
        .catch(error => {
          console.error(`Editor ${id} error:`, error);
        });
    });
  </script>
</x-layout-admin>
