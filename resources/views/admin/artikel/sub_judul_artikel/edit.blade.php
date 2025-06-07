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
                <h3 class="card-title">Edit Subjudul Artikel</h3>
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
              <form method="POST" action="{{ route('admin_subjudul-artikel.update', $subjudul_artikel->id) }}">
                <div class="card-body">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="subjek_materi">Judul Artikel</label>
                    <select name="id_artikel" class="form-control" required>
                      @foreach ($artikels as $artikel)
                        <option value="{{ $artikel->id }}"
                          {{ $subjudul_artikel->id_artikel == $artikel->id ? 'selected' : '' }}>
                          {{ $artikel->judul }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="sub_judul">Sub Judul Artikel</label>
                    <input type="text" name="sub_judul" class="form-control" id="sub_judul"
                      value="{{ $subjudul_artikel->sub_judul }}" placeholder="Masukkan Sub Judul Artikel" required>
                  </div>
                  <div class="form-group">
                    <label for="urutan">Urutan</label>
                    <input type="number" name="urutan" class="form-control" id="Urutan"
                      value="{{ $subjudul_artikel->urutan }}" placeholder="Masukkan Urutan Sub Judul Artikel" required>
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
