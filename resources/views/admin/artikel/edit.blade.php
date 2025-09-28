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
                <h3 class="card-title">Edit Data Artikel</h3>
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
              <form method="POST" action="{{ route('admin_artikel.update', $artikel->id) }}"
                enctype="multipart/form-data">

                <div class="card-body">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="subjek_materi">Subjek Materi</label>
                    <select name="subjek_materi_id" class="form-control" required>
                      @foreach ($subjek_materi as $item)
                        <option value="{{ $item->id }}"
                          {{ $artikel->subjek_materi_id == $item->id ? 'selected' : '' }}>
                          {{ $item->judul }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="judul_artikel">Judul Artikel</label>
                    <input type="text" name="judul" class="form-control" id="judul_artikel"
                      value="{{ $artikel->judul }}" placeholder="Masukkan Judul Artikel" required>
                  </div>
                  <div class="form-group">
                    <label for="deskripsi_artikel">Deskripsi Artikel</label>
                    <input type="text" name="deskripsi" class="form-control" id="deskripsi_artikel"
                      value="{{ $artikel->deskripsi }}" placeholder="Masukkan Deskripsi Artikel" required>
                  </div>
                  <div class="form-group">
                    <label for="gambar">Gambar Artikel</label>
                    <input type="file" name="gambar" class="form-control" id="gambar"
                      value="{{ $artikel->gambar }}" accept="image/jpg, image/jpeg, image/png"
                      placeholder="Masukkan Gambar Artikel">
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
