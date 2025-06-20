<x-layout-admin>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Input Subjudul Artikel</h3>
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
          <form method="POST" action="{{ route('admin_subjudul-artikel.store') }}">
            <div class="card-body">
              @csrf
              <div class="form-group">
                <label for="judul_artikel">Judul Artikel</label>
                <select name="id_artikel" class="form-control" required>
                  <option value="" disabled selected>-- Pilih Judul Artikel --</option>
                  @foreach ($artikel as $item)
                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="subjudul_artikel">Sub Judul Artikel</label>
                <input type="text" name="sub_judul" class="form-control" id="subjudul_artikel"
                  placeholder="Masukkan Sub Judul Artikel" required>
              </div>
              <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" name="urutan" class="form-control" id="urutan"
                  placeholder="Masukkan Urutan Sub Judul Artikel" required>
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
