<x-layout-admin>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Soal Kuis Tantangan Bulanan</h3>
          </div>

          <form method="POST"
            action="{{ route('admin_soal-kuis-tantangan-bulanan.update-batch', $batch->upload_batch_id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="kuis_tantangan_bulanan">Judul Tantangan</label>
                <select name="id_kuis_tantangan_bulanan" class="form-control" required>
                  @foreach ($kuis_tantangan_bulanan as $item)
                    <option value="{{ $item->id }}"
                      {{ $item->id == $batch->id_kuis_tantangan_bulanan ? 'selected' : '' }}>
                      {{ $item->judul }} - Periode {{ $item->periode->periode }}
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

  {{-- Toggle logic --}}
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
        selectJawaban.setAttribute('name', 'jawaban');
        inputJawaban.removeAttribute('name');
      } else if (tipe === 'Isian Singkat') {
        pilihanGandaDiv.style.display = 'none';
        isianSingkatDiv.style.display = 'block';
        inputJawaban.setAttribute('name', 'jawaban');
        selectJawaban.removeAttribute('name');
      }
    }

    document.addEventListener('DOMContentLoaded', toggleInputFields);
    document.getElementById('tipe_soal').addEventListener('change', toggleInputFields);
  </script>
</x-layout-admin>
