<x-layout-admin>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Soal Kuis Reguler</h3>
          </div>

          <form method="POST" action="{{ route('admin_soal-kuis-reguler.update', $soal->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="kuis_reguler">Topik Kuis</label>
                <select name="kuis_reguler" class="form-control" required>
                  @foreach ($kuis_reguler as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $soal->id_kuis_reguler ? 'selected' : '' }}>
                      {{ $item->judul }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="soal">Soal</label>
                <input type="text" name="soal" class="form-control" value="{{ $soal->soal }}" required>
              </div>

              <div class="form-group">
                <label for="tipe_soal">Tipe Soal</label>
                <select name="tipe_soal" id="tipe_soal" class="form-control" required>
                  <option value="Pilihan Ganda" {{ $soal->tipe_soal == 'Pilihan Ganda' ? 'selected' : '' }}>Pilihan
                    Ganda</option>
                  <option value="Isian Singkat" {{ $soal->tipe_soal == 'Isian Singkat' ? 'selected' : '' }}>Isian
                    Singkat</option>
                </select>
              </div>

              {{-- Pilihan Ganda --}}
              <div id="pilihan_ganda_fields" style="display: none;">
                <label>Opsi Jawaban</label>
                @php
                  $opsi = $soal->opsi->keyBy('label');
                @endphp
                @foreach (['A', 'B', 'C', 'D'] as $label)
                  <div class="form-group">
                    <label>Opsi {{ $label }}</label>
                    <input type="text" name="options[{{ $label }}]" class="form-control"
                      value="{{ $opsi[$label]->teks_opsi ?? '' }}">
                  </div>
                @endforeach

                <div class="form-group">
                  <label>Jawaban Benar</label>
                  <select class="form-control" name="jawaban">
                    <option value="" disabled>-- Pilih Jawaban Benar --</option>
                    @foreach (['A', 'B', 'C', 'D'] as $label)
                      <option value="{{ $label }}" {{ $soal->jawaban === $label ? 'selected' : '' }}>
                        {{ $label }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              {{-- Isian Singkat --}}
              <div id="isian_singkat_field" style="display: none;">
                <div class="form-group">
                  <label>Jawaban Benar</label>
                  <input type="text" class="form-control"
                    value="{{ $soal->tipe_soal == 'Isian Singkat' ? $soal->jawaban : '' }}">
                </div>
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
