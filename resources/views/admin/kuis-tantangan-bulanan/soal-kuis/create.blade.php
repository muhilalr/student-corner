<x-layout-admin>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Input Soal Kuis Tantangan Bulanan</h3>
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

          <form method="POST" action="{{ route('admin_soal-kuis-tantangan-bulanan.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="kuis_tantangan_bulanan">Judul Tantangan</label>
                <select name="id_kuis_tantangan_bulanan" class="form-control" required>
                  <option value="" disabled selected>-- Pilih Topik Kuis --</option>
                  @foreach ($kuis_tantangan_bulanan as $item)
                    <option value="{{ $item->id }}">{{ $item->judul }} - Periode {{ $item->periode->periode }}
                    </option>
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
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>

  {{-- Script Dinamis --}}
  <script>
    function toggleInputFields() {
      const tipe = document.getElementById('tipe_soal').value;

      const pilihanGandaDiv = document.getElementById('pilihan_ganda_fields');
      const isianSingkatDiv = document.getElementById('isian_singkat_field');

      const selectJawaban = pilihanGandaDiv.querySelector('select');
      const inputJawaban = isianSingkatDiv.querySelector('input');

      if (tipe === 'Pilihan Ganda') {
        pilihanGandaDiv.style.display = 'block';
        isianSingkatDiv.style.display = 'none';

        // Set 'name' hanya pada input Pilihan Ganda
        selectJawaban.setAttribute('name', 'jawaban');
        inputJawaban.removeAttribute('name');
      } else if (tipe === 'Isian Singkat') {
        pilihanGandaDiv.style.display = 'none';
        isianSingkatDiv.style.display = 'block';

        // Set 'name' hanya pada input Isian Singkat
        inputJawaban.setAttribute('name', 'jawaban');
        selectJawaban.removeAttribute('name');
      } else {
        pilihanGandaDiv.style.display = 'none';
        isianSingkatDiv.style.display = 'none';

        selectJawaban.removeAttribute('name');
        inputJawaban.removeAttribute('name');
      }
    }

    document.addEventListener('DOMContentLoaded', toggleInputFields);
    document.getElementById('tipe_soal').addEventListener('change', toggleInputFields);
  </script>

</x-layout-admin>
