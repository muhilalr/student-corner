<x-layout-web>
  <!-- Main Content -->
  <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Hasil -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-8">
      <div class="bg-gradient-to-r from-primary to-blue-600 p-8 text-white text-center">
        <div class="mb-4">
          @if ($hasilQuiz->persentase >= 80)
            <div class="mx-auto w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mb-4">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h1 class="text-3xl font-bold mb-2">🎉 Selamat!</h1>
            <p class="text-blue-100">Anda berhasil menyelesaikan quiz dengan baik</p>
          @elseif($hasilQuiz->persentase >= 60)
            <div class="mx-auto w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mb-4">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h1 class="text-3xl font-bold mb-2">👍 Bagus!</h1>
            <p class="text-blue-100">Hasil yang cukup baik, terus tingkatkan!</p>
          @else
            <div class="mx-auto w-16 h-16 bg-red-500 rounded-full flex items-center justify-center mb-4">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h1 class="text-3xl font-bold mb-2">💪 Semangat!</h1>
            <p class="text-blue-100">Jangan menyerah, terus belajar dan coba lagi!</p>
          @endif
        </div>
      </div>

      <!-- Statistik Hasil -->
      <div class="p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="text-center">
            <div class="bg-blue-50 rounded-lg p-6">
              <div class="text-3xl font-bold text-primary mb-2">{{ $hasilQuiz->skor }}</div>
              <div class="text-gray-600 font-medium">Jawaban Benar</div>
            </div>
          </div>
          <div class="text-center">
            <div class="bg-green-50 rounded-lg p-6">
              <div class="text-3xl font-bold text-green-600 mb-2">{{ $hasilQuiz->total_soal }}</div>
              <div class="text-gray-600 font-medium">Total Soal</div>
            </div>
          </div>
          <div class="text-center">
            <div class="bg-purple-50 rounded-lg p-6">
              <div class="text-3xl font-bold text-purple-600 mb-2">{{ $hasilQuiz->persentase }}%</div>
              <div class="text-gray-600 font-medium">Persentase</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Detail Jawaban -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
      <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-bold text-gray-900">Detail Jawaban</h2>
        <p class="text-gray-600 text-sm mt-1">Review jawaban Anda untuk setiap pertanyaan</p>
      </div>

      <div class="p-6">
        @if (isset($detailVerifikasi) && is_array($detailVerifikasi))
          <div class="space-y-6">
            @foreach ($detailVerifikasi as $index => $detail)
              <div class="border border-gray-200 rounded-xl overflow-hidden">
                <!-- Header Soal -->
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                      <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                        <span class="text-sm font-bold text-primary">{{ $index + 1 }}</span>
                      </div>
                      <span class="text-sm font-medium text-gray-600">
                        {{ ucfirst(str_replace('_', ' ', $detail['tipe_soal'])) }}
                      </span>
                    </div>
                    <div class="flex items-center">
                      @if ($detail['is_correct'])
                        <span
                          class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                          <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                              clip-rule="evenodd"></path>
                          </svg>
                          Benar
                        </span>
                      @else
                        <span
                          class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                          <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                          </svg>
                          Salah
                        </span>
                      @endif
                    </div>
                  </div>
                </div>

                <!-- Konten Soal -->
                <div class="p-6">
                  <h3 class="text-lg font-medium text-gray-900 mb-4">{{ $detail['soal'] }}</h3>

                  <div class="space-y-4">
                    <!-- Jawaban User -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                      <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                          <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                            </svg>
                          </div>
                        </div>
                        <div class="flex-1">
                          <p class="text-sm font-medium text-blue-900">Jawaban Anda:</p>
                          <p class="text-blue-800 mt-1">
                            @if ($detail['tipe_soal'] === 'Isian Singkat')
                              "{{ $detail['jawaban_user'] }}"
                              @if (isset($detail['jawaban_user_normalized']))
                                <span class="text-xs text-blue-600 block mt-1">
                                  (Dinormalisasi: "{{ $detail['jawaban_user_normalized'] }}")
                                </span>
                              @endif
                            @else
                              {{ $detail['jawaban_user'] }}
                            @endif
                          </p>
                        </div>
                      </div>
                    </div>

                    <!-- Jawaban Benar -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                      <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                          <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                            </svg>
                          </div>
                        </div>
                        <div class="flex-1">
                          <p class="text-sm font-medium text-green-900">Jawaban Benar:</p>
                          <p class="text-green-800 mt-1">
                            @if ($detail['tipe_soal'] === 'Isian Singkat')
                              "{{ $detail['jawaban_benar'] }}"
                              @if (isset($detail['jawaban_benar_normalized']))
                                <span class="text-xs text-green-600 block mt-1">
                                  (Dinormalisasi: "{{ $detail['jawaban_benar_normalized'] }}")
                                </span>
                              @endif
                            @else
                              {{ $detail['jawaban_benar'] }}
                            @endif
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="text-center py-8">
            <div class="text-gray-400 mb-4">
              <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
              </svg>
            </div>
            <p class="text-gray-500">Detail jawaban tidak tersedia</p>
          </div>
        @endif
      </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
      <a href="{{ route('quiz.index') }}"
        class="inline-flex items-center justify-center px-6 py-3 border border-primary text-primary bg-white hover:bg-primary hover:text-white rounded-xl font-medium transition-all duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
          </path>
        </svg>
        Coba Lagi
      </a>

      <button onclick="window.print()"
        class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 text-white hover:bg-gray-700 rounded-xl font-medium transition-all duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
          </path>
        </svg>
        Cetak Hasil
      </button>

      <a href="{{ url('/') }}"
        class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white hover:bg-primary/90 rounded-xl font-medium transition-all duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
          </path>
        </svg>
        Kembali ke Beranda
      </a>
    </div>
  </main>

  <style>
    @media print {
      .no-print {
        display: none !important;
      }

      body {
        background: white !important;
      }

      .shadow-xl {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
      }
    }
  </style>
</x-layout-web>
