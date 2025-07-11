<x-layout-web>
  <div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Hasil Kuis</h1>
      <p class="text-gray-600">{{ $hasil->kuis_reguler->judul }}</p>
    </div>

    <!-- Hasil Utama -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Skor -->
        <div class="text-center">
          <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
            <span class="text-2xl font-bold text-blue-600">{{ $hasil->skor }}</span>
          </div>
          <h3 class="font-semibold text-gray-900">Skor</h3>
          <p class="text-sm text-gray-600">dari 100</p>
        </div>

        <!-- Jawaban Benar -->
        <div class="text-center">
          <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
            <span class="text-2xl font-bold text-green-600">{{ $hasil->jawaban_benar }}</span>
          </div>
          <h3 class="font-semibold text-gray-900">Benar</h3>
          <p class="text-sm text-gray-600">jawaban</p>
        </div>

        <!-- Jawaban Salah -->
        <div class="text-center">
          <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
            <span class="text-2xl font-bold text-red-600">{{ $hasil->jawaban_salah }}</span>
          </div>
          <h3 class="font-semibold text-gray-900">Salah</h3>
          <p class="text-sm text-gray-600">jawaban</p>
        </div>

        <!-- Durasi -->
        <div class="text-center">
          <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="font-semibold text-gray-900">Durasi</h3>
          <p class="text-sm text-gray-600">{{ $hasil->durasi_format }}</p>
        </div>
      </div>
    </div>

    <!-- Statistik Tambahan -->
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
      <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Detail</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-gray-50 p-4 rounded-lg">
          <h4 class="font-medium text-gray-900">Total Soal</h4>
          <p class="text-2xl font-bold text-gray-700">{{ $hasil->jawaban_benar + $hasil->jawaban_salah }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
          <h4 class="font-medium text-gray-900">Persentase Benar</h4>
          <p class="text-2xl font-bold text-green-600">
            {{ round(($hasil->jawaban_benar / ($hasil->jawaban_benar + $hasil->jawaban_salah)) * 100, 1) }}%</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
          <h4 class="font-medium text-gray-900">Waktu Tersisa</h4>
          @php
            $waktuTersisa = $hasil->kuis_reguler->durasi_menit * 60 - $hasil->durasi_pengerjaan;
            $menitTersisa = floor($waktuTersisa / 60);
            $detikTersisa = $waktuTersisa % 60;
          @endphp
          <p class="text-2xl font-bold text-blue-600">
            @if ($waktuTersisa > 0)
              {{ $menitTersisa }}:{{ str_pad($detikTersisa, 2, '0', STR_PAD_LEFT) }}
            @else
              00:00
            @endif
          </p>
        </div>
      </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="text-center">
      <a href="{{ route('kuis-tantangan.index') }}"
        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
        </svg>
        Kembali ke Daftar Kuis
      </a>
    </div>
  </div>
</x-layout-web>
