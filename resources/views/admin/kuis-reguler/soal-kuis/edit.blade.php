<x-layout-admin>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Soal Kuis Reguler</h3>
          </div>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('admin_soal-kuis-reguler.update-batch', $batch->upload_batch_id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="kuis_reguler">Topik Kuis</label>
                <select name="id_kuis_reguler" class="form-control" required>
                  @foreach ($kuis_reguler as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $batch->id_kuis_reguler ? 'selected' : '' }}>
                      {{ $item->judul }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="file">Upload File Excel Baru</label>
                <input type="file" name="file" accept=".xlsx" class="form-control" required>
              </div>

              <div class="form-group">
                <label for="images">Upload Gambar Baru (jika ada)</label>
                <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                <small>Upload semua gambar baru yang diperlukan</small>
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>


</x-layout-admin>
