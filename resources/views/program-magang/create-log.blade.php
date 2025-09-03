<x-layout-web>
  <div class="bg-white rounded-xl shadow-lg md:max-w-4xl my-10 py-8 mx-6 md:mx-auto px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
      <div class="flex flex-col justify-center items-center">
        <h1 class="text-xl md:text-3xl font-bold text-gray-900 mb-2">Tambah Log Harian Magang</h1>
        <p class="text-sm md:text-base font-semibold text-gray-600">Tambah aktivitas harian selama masa magang</p>
      </div>
    </div>
    <form action="{{ route('log-harian.store') }}" method="POST">
      @csrf
      <input type="hidden" name="id_pendaftaran_magang" value="{{ $pendaftaran->id }}">
      <div class="grid md:grid-cols-2 gap-6 px-6 mb-6">
        <!-- Tanggal -->
        <div>
          <div class="flex items-center mb-2">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <x-input-label for="tanggal" :value="__('Tanggal')" />
          </div>
          <x-text-input id="tanggal" class="w-full px-4 py-3 rounded-xl bg-white/80" type="date" name="tanggal"
            :value="date('Y-m-d')" readonly required />
          <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
        </div>

        <!-- Status Kehadiran -->
        <div>
          <div class="flex items-center mb-2">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <x-input-label for="status_kehadiran" :value="__('Tanggal Selesai')" />
          </div>
          <select name="status_kehadiran" id="status_kehadiran"
            class="w-full px-4 py-3 border rounded-xl shadow-sm focus:border-primary focus:ring-primary bg-white"
            required>
            <option value="" disabled selected>-- Status Kehadiran --</option>
            <option value="hadir">Hadir</option>
            <option value="sakit">Sakit</option>
            <option value="izin">Izin</option>
          </select>
          <x-input-error :messages="$errors->get('status_kehadiran')" class="mt-2" />
        </div>
      </div>

      <div class="grid grid-cols-1 gap-6 px-6 mb-6">
        <div>
          <div class="flex items-center mb-2">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            <x-input-label for="uraian kegiatan" :value="__('Uraian Kegiatan')" />
          </div>
          <textarea id="editor-uraian" name="uraian_kegiatan"
            class="w-full px-4 py-3 border rounded-xl shadow-sm focus:border-primary focus:ring-primary bg-white resize-none"
            placeholder="Jelaskan aktivitas magang hari ini"></textarea>
          <x-input-error :messages="$errors->get('uraian_kegiatan')" class="mt-2" />
        </div>

        <div>
          <div class="flex items-center mb-2">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            <x-input-label for="catatan" :value="__('Catatan (Opsional)')" />
          </div>
          <textarea id="editor-catatan" name="catatan"
            class="w-full px-4 py-3 border rounded-xl shadow-sm focus:border-primary focus:ring-primary bg-white resize-none"
            placeholder="Masukkan catatan (Jika Ada)"></textarea>
          <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
        </div>
      </div>
      <div class="flex justify-center items-center">
        <button type="submit" class="bg-primary hover:bg-[#00295A] text-white px-4 py-2 rounded-lg font-medium">
          Tambah Log
        </button>
      </div>
    </form>
  </div>

  <x-footer class="fill-[#EEF0F2]" />

  <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@35.3.0/build/ckeditor.js"></script>
  <script>
    const editors = ['editor-uraian', 'editor-catatan'];
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
</x-layout-web>
