<x-layout-web>
  <!-- Header Section -->
  <div class="bg-gradient-to-r from-primary to-blue-700 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="text-center">
        <h1 class="text-3xl font-bold mb-2">📋 Review Jawaban</h1>
        <p class="text-blue-100 text-lg">{{ $hasil->kuis_reguler->judul }}</p>
        <div class="flex justify-center items-center space-x-6 mt-4 text-sm">
          <div class="bg-white/10 px-4 py-2 rounded-full">
            <span class="font-medium">Skor: {{ $hasil->skor }}</span>
          </div>
          <div class="bg-white/10 px-4 py-2 rounded-full">
            <span class="font-medium">Benar: {{ $hasil->jawaban_benar }}</span>
          </div>
          <div class="bg-white/10 px-4 py-2 rounded-full">
            <span class="font-medium">Salah: {{ $hasil->jawaban_salah }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Legend -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 mb-8">
      <h3 class="text-lg font-semibold mb-4">Keterangan:</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="flex items-center space-x-3">
          <div class="w-4 h-4 bg-green-500 rounded-full"></div>
          <span class="text-sm font-medium">Jawaban Benar</span>
        </div>
        <div class="flex items-center space-x-3">
          <div class="w-4 h-4 bg-red-500 rounded-full"></div>
          <span class="text-sm font-medium">Jawaban Salah</span>
        </div>
        <div class="flex items-center space-x-3">
          <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
          <span class="text-sm font-medium">Jawaban Benar (Referensi)</span>
        </div>
      </div>
    </div>

    <!-- Questions Review -->
    @foreach ($soalWithJawaban as $index => $item)
      <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden mb-6 animate-fade-in">
        <!-- Question Header -->
        <div class="bg-gray-50 p-6 border-b border-gray-200">
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-primary text-white rounded-lg flex items-center justify-center">
                <span class="text-sm font-bold">{{ $index + 1 }}</span>
              </div>
              <span class="text-gray-700 text-sm font-medium">Pertanyaan {{ $index + 1 }}</span>
              <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded-full">
                {{ $item['soal']->tipe_soal }}
              </span>
            </div>
            <!-- Status Badge -->
            <div class="flex items-center space-x-2">
              @if ($item['is_correct'])
                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                  ✓ Benar
                </div>
              @else
                <div class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                  ✗ Salah
                </div>
              @endif
            </div>
          </div>

          <!-- Question Image -->
          @if ($item['soal']->gambar)
            <div class="max-w-md mx-auto mb-4">
              <img src="{{ asset('storage/gambar_soal_kuis_reguler/' . $item['soal']->gambar) }}" alt="Gambar Soal"
                class="w-full object-cover rounded-lg">
            </div>
          @endif

          <!-- Question Text -->
          <h3 class="text-lg font-semibold text-gray-900 leading-tight">
            {{ $item['soal']->soal }}
          </h3>
        </div>

        <!-- Answer Section -->
        <div class="p-6">
          @if ($item['soal']->tipe_soal === 'Pilihan Ganda')
            <!-- Multiple Choice Review -->
            <div class="space-y-3">
              @foreach ($item['soal']->opsi as $opsi)
                <div
                  class="flex items-center space-x-4 p-4 rounded-xl border-2 
                  @if ($item['opsi_terpilih'] && $item['opsi_terpilih']->id === $opsi->id) @if ($item['is_correct'])
                      border-green-500 bg-green-50
                    @else
                      border-red-500 bg-red-50 @endif
@elseif ($item['opsi_benar'] && $item['opsi_benar']->id === $opsi->id)
border-blue-500 bg-blue-50
@else
border-gray-200 bg-gray-50
                  @endif
                ">
                  <div class="flex items-center space-x-3">
                    <!-- Radio Button Visual -->
                    <div
                      class="w-5 h-5 rounded-full border-2 flex items-center justify-center
                      @if ($item['opsi_terpilih'] && $item['opsi_terpilih']->id === $opsi->id) @if ($item['is_correct'])
                          border-green-500 bg-green-500
                        @else
                          border-red-500 bg-red-500 @endif
@elseif ($item['opsi_benar'] && $item['opsi_benar']->id === $opsi->id)
border-blue-500 bg-blue-500
@else
border-gray-300
                      @endif
                    ">
                      @if (
                          ($item['opsi_terpilih'] && $item['opsi_terpilih']->id === $opsi->id) ||
                              ($item['opsi_benar'] && $item['opsi_benar']->id === $opsi->id))
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                      @endif
                    </div>

                    <!-- Option Text -->
                    <p
                      class="font-medium
                      @if ($item['opsi_terpilih'] && $item['opsi_terpilih']->id === $opsi->id) @if ($item['is_correct'])
                          text-green-800
                        @else
                          text-red-800 @endif
@elseif ($item['opsi_benar'] && $item['opsi_benar']->id === $opsi->id)
text-blue-800
@else
text-gray-700
                      @endif
                    ">
                      {{ $opsi->label }}. {{ $opsi->teks_opsi }}
                    </p>
                  </div>

                  <!-- Status Icons -->
                  <div class="ml-auto flex items-center space-x-2">
                    @if ($item['opsi_terpilih'] && $item['opsi_terpilih']->id === $opsi->id)
                      <span
                        class="text-sm font-medium
                        @if ($item['is_correct']) text-green-700
                        @else
                          text-red-700 @endif
                      ">
                        Jawaban Anda
                      </span>
                      @if ($item['is_correct'])
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                          </path>
                        </svg>
                      @else
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                      @endif
                    @elseif ($item['opsi_benar'] && $item['opsi_benar']->id === $opsi->id && !$item['is_correct'])
                      <span class="text-sm font-medium text-blue-700">Jawaban Benar</span>
                      <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    @endif
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <!-- Short Answer Review -->
            <div class="space-y-4">
              <!-- User Answer -->
              <div
                class="p-4 rounded-xl border-2 
                @if ($item['is_correct']) border-green-500 bg-green-50
                @else
                  border-red-500 bg-red-50 @endif
              ">
                <div class="flex items-center justify-between mb-2">
                  <span class="text-sm font-medium text-gray-700">Jawaban Anda:</span>
                  @if ($item['is_correct'])
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                  @else
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                      </path>
                    </svg>
                  @endif
                </div>
                <p
                  class="font-medium
                  @if ($item['is_correct']) text-green-800
                  @else
                    text-red-800 @endif
                ">
                  {{ $item['jawaban_user']->jawaban_user ?? 'Tidak dijawab' }}
                </p>
              </div>

              <!-- Correct Answer (if user was wrong) -->
              @if (!$item['is_correct'])
                <div class="p-4 rounded-xl border-2 border-blue-500 bg-blue-50">
                  <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700">Jawaban Benar:</span>
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <p class="font-medium text-blue-800">{{ $item['soal']->jawaban }}</p>
                </div>
              @endif
            </div>
          @endif
        </div>
      </div>
    @endforeach

    <!-- Back Button -->
    <div class="text-center mt-8">
      <a href="{{ route('kuis-tantangan.index') }}"
        class="inline-flex items-center px-6 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
          </path>
        </svg>
        Kembali ke Kuis & Tantangan
      </a>
    </div>
  </main>

  <x-footer class="fill-[#EEF0F2]"></x-footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add fade-in animation to questions
      const questions = document.querySelectorAll('.animate-fade-in');
      questions.forEach((question, index) => {
        setTimeout(() => {
          question.style.opacity = '1';
          question.style.transform = 'translateY(0)';
        }, index * 100);
      });
    });
  </script>

  <style>
    .animate-fade-in {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.3s ease, transform 0.3s ease;
    }
  </style>
</x-layout-web>
