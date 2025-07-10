<x-layout-admin>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        {{-- Card Import Soal dari Excel --}}
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Import Soal Kuis Reguler dari Excel</h3>
          </div>


          {{-- Notifikasi Error --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          {{-- Notifikasi Sukses --}}
          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          {{-- Form Upload --}}
          <form method="POST" action="{{ route('admin_soal-kuis-reguler.store') }}" enctype="multipart/form-data">
            <div class="card-body">
              @csrf

              {{-- Pilih Topik Kuis --}}
              <div class="form-group">
                <label for="id_kuis_reguler">Topik Kuis</label>
                <select name="id_kuis_reguler" class="form-control" required>
                  <option value="" disabled selected>-- Pilih Topik Kuis --</option>
                  @foreach ($kuis_reguler as $item)
                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                  @endforeach
                </select>
              </div>

              {{-- Upload Excel --}}
              <div class="form-group">
                <label for="file">File Excel Soal</label>
                <p>
                  📥 Download template terlebih dahulu:
                  <a href="{{ asset('template_soal_kuis/Soal_Kuis_Template.xlsx') }}" download
                    class="text-blue-600 underline">
                    Download Template Excel
                  </a>
                </p>
                <input type="file" name="file" accept=".xlsx" class="form-control" required>
                <small class="form-text text-muted">Kolom <b>Gambar</b> berisi nama file gambar (misal:
                  <code>soal1.jpg</code>)</small>
              </div>

              {{-- Upload Banyak Gambar --}}
              <div class="form-group">
                <label for="images">Upload Gambar Soal (jika ada)</label>
                <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                <small class="form-text text-muted">Upload semua gambar yang digunakan pada Excel</small>
              </div>
            </div>


            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Import Soal</button>
            </div>
          </form>

        </div>
      </div>
    </section>
  </div>
</x-layout-admin>
