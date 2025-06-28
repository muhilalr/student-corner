<x-layout-admin>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Input Soal Kuis Reguler</h3>
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

          <form method="POST" action="{{ route('admin_soal-kuis-reguler.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="kuis_reguler">Topik Kuis</label>
                <select name="kuis_reguler" class="form-control" required>
                  <option value="" disabled selected>-- Pilih Topik Kuis --</option>
                  @foreach ($kuis_reguler as $item)
                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="gambar">Gambar (Optional)</label>
                <input type="file" name="gambar" class="form-control" id="gambar" placeholder="Masukkan Gambar">
              </div>
              <div class="form-group">
                <label for="soal">Soal</label>
                <input type="text" name="soal" class="form-control" id="soal"
                  placeholder="Masukkan Soal Kuis" required>
              </div>

              <div class="form-group">
                <label for="tipe_soal">Tipe Soal</label>
                <select name="tipe_soal" class="form-control" id="tipe_soal" onchange="toggleInputFields()" required>
                  <option value="" disabled selected>-- Pilih Tipe Soal --</option>
                  <option value="Pilihan Ganda">Pilihan Ganda</option>
                  <option value="Isian Singkat">Isian Singkat</option>
                </select>
              </div>

              {{-- Opsi Pilihan Ganda --}}
              <div id="pilihan_ganda_fields" style="display: none;">
                <div class="form-group">
                  <label>Opsi A</label>
                  <input type="text" name="options[A]" class="form-control" placeholder="Opsi A">
                </div>
                <div class="form-group">
                  <label>Opsi B</label>
                  <input type="text" name="options[B]" class="form-control" placeholder="Opsi B">
                </div>
                <div class="form-group">
                  <label>Opsi C</label>
                  <input type="text" name="options[C]" class="form-control" placeholder="Opsi C">
                </div>
                <div class="form-group">
                  <label>Opsi D</label>
                  <input type="text" name="options[D]" class="form-control" placeholder="Opsi D">
                </div>

                <div class="form-group">
                  <label>Jawaban Benar</label>
                  <select name="jawaban" class="form-control">
                    <option value="" disabled selected>-- Pilih Jawaban Benar --</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                  </select>
                </div>
              </div>

              {{-- Jawaban Isian Singkat --}}
              <div id="isian_singkat_field" style="display: none;">
                <div class="form-group">
                  <label>Jawaban Benar</label>
                  <input type="text" name="jawaban" class="form-control" placeholder="Masukkan jawaban singkat">
                </div>
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
