<x-layout-web>
  <!-- Main Content -->
  <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if (isset($sudahSubmit) && $sudahSubmit)
      <div class="bg-green-100 border border-green-300 text-green-700 rounded-xl p-6 mb-8">
        <h2 class="text-xl font-bold mb-2">Skor Anda: {{ $skor }} / {{ count($soal) }}</h2>
        <p>Berikut ini adalah jawaban dan penilaian Anda:</p>
      </div>

      @foreach ($soal as $index => $item)
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
          <div class="bg-primary p-6 text-white">
            <div class="flex items-center space-x-3 mb-4">
              <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <span class="text-sm font-bold">{{ $index + 1 }}</span>
              </div>
              <span class="text-blue-100 text-sm font-medium">Pertanyaan {{ $index + 1 }}</span>
              <span class="bg-white/20 text-xs px-2 py-1 rounded-full">{{ $item->tipe_soal }}</span>
            </div>
            <h2 class="text-xl sm:text-2xl font-bold leading-tight">{{ $item->soal }}</h2>
          </div>

          <div class="p-6 sm:p-8">

            @php
              $jawaban = $jawabanUser[$item->id] ?? null;
              $jawabanBenar = $item->jawaban;
              $isBenar = strtolower(trim($jawaban)) === strtolower(trim($jawabanBenar));

              // Ambil teks dari opsi user
              $opsiUser = $item->opsi->firstWhere('label', $jawaban);
              $opsiBenar = $item->opsi->firstWhere('label', $jawabanBenar);
            @endphp

            <p><strong>Jawaban Anda:</strong> <span
                class="{{ $isBenar ? 'text-green-600' : 'text-red-600' }}">{{ $jawaban }}.
                {{ $opsiUser->teks_opsi ?? '-' }}</span></p>
            <p><strong>Jawaban Benar:</strong> <span class="text-primary">{{ $jawabanBenar }}.
                {{ $opsiBenar->teks_opsi ?? '-' }}</span></p>

            @if ($isBenar)
              <div class="mt-3 p-3 bg-green-50 text-green-700 rounded-lg border border-green-300">Jawaban Anda benar 🎉
              </div>
            @else
              <div class="mt-3 p-3 bg-red-50 text-red-700 rounded-lg border border-red-300">Jawaban Anda salah ❌</div>
            @endif

          </div>
        </div>
      @endforeach
    @endif

    @if (!isset($sudahSubmit) || !$sudahSubmit)
      <form id="quizForm" class="space-y-8" action="{{ route('kuis.submit', $kuis->slug) }}" method="POST">
        @csrf
        <input type="hidden" name="kuis_id" value="{{ $kuis->id }}">
        @foreach ($soal as $index => $item)
          <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden animate-fade-in">
            <div class="bg-primary p-6 text-white">
              <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                  <span class="text-sm font-bold">{{ $index + 1 }}</span>
                </div>
                <span class="text-blue-100 text-sm font-medium">Pertanyaan {{ $index + 1 }}</span>
                <span class="bg-white/20 text-xs px-2 py-1 rounded-full">
                  {{ $item->tipe_soal }}
                </span>
              </div>
              <h2 class="text-xl sm:text-2xl font-bold leading-tight">
                {{ $item->soal }}
              </h2>
            </div>
            <div class="p-6 sm:p-8">
              @if ($item->tipe_soal === 'Pilihan Ganda')
                <!-- Tampilan Pilihan Ganda -->
                <div class="space-y-4">
                  @foreach ($item->opsi as $opsi)
                    <label
                      class="flex items-center space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-primary cursor-pointer transition-all duration-200 question-option">
                      <input type="radio" name="jawaban_{{ $item->id }}" value="{{ $opsi->label }}"
                        data-question-id="{{ $item->id }}" data-question-type="multiple_choice"
                        data-correct-answer="{{ $item->jawaban }}"
                        class="text-primary border-gray-300 focus:ring-primary question-input">
                      <p class="text-gray-900 font-medium">{{ $opsi->label }}. {{ $opsi->teks_opsi }}</p>
                    </label>
                  @endforeach
                </div>
              @elseif($item->tipe_soal === 'Isian Singkat')
                <!-- Tampilan Isian Singkat -->
                <div class="space-y-4">
                  <div class="relative">
                    <label for="jawaban_{{ $item->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                      Jawaban Anda:
                    </label>
                    <input type="text" id="jawaban_{{ $item->id }}" name="jawaban_{{ $item->id }}"
                      data-question-id="{{ $item->id }}" data-question-type="short_answer"
                      data-correct-answer="{{ $item->jawaban }}"
                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary focus:outline-none transition-all duration-200 question-input"
                      placeholder="Ketik jawaban Anda di sini..." autocomplete="off">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none mt-8">
                      <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                        </path>
                      </svg>
                    </div>
                  </div>
                  <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                    <div class="flex">
                      <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                        </svg>
                      </div>
                      <div class="ml-3">
                        <p class="text-sm text-blue-700">
                          <strong>Tips:</strong> Pastikan ejaan dan huruf besar/kecil sesuai. Jawaban akan diperiksa
                          secara otomatis.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
        @endforeach

        <!-- Submit Button -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 text-center animate-fade-in">
          <div class="max-w-md mx-auto">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Selesai Mengerjakan?</h3>
            <p class="text-gray-600 mb-6">Pastikan semua jawaban sudah terisi sebelum mengirim kuis.</p>

            <!-- Progress Bar -->
            <div class="mb-6">
              <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span>Progress</span>
                <span id="progressText">0/{{ count($soal) }}</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="progressBar" class="bg-primary h-2 rounded-full transition-all duration-300" style="width: 0%">
                </div>
              </div>
            </div>

            <button type="submit" id="submitButton" disabled
              class="w-full bg-gray-400 text-white font-bold py-4 px-8 rounded-xl transition-all duration-200 shadow-lg text-lg cursor-not-allowed">
              <span class="flex items-center justify-center space-x-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Kirim Jawaban</span>
              </span>
            </button>
            <p class="text-sm text-gray-500 mt-4">Setelah dikirim, jawaban tidak dapat diubah lagi.</p>
          </div>
        </div>
      </form>
    @endif

    <!-- Modal Konfirmasi -->
    <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
      <div class="bg-white rounded-2xl shadow-2xl max-w-md mx-4 p-8">
        <div class="text-center">
          <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 mb-4">
            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Konfirmasi Pengiriman</h3>
          <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin mengirim jawaban? Skor Anda adalah <span
              id="finalScore" class="font-bold text-primary"></span></p>
          <div class="flex space-x-3">
            <button id="cancelSubmit"
              class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors">
              Batal
            </button>
            <button id="confirmSubmit"
              class="flex-1 bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors">
              Ya, Kirim
            </button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.getElementById('quizForm');
      const inputs = document.querySelectorAll('.question-input');
      const submitButton = document.getElementById('submitButton');
      const progressBar = document.getElementById('progressBar');
      const progressText = document.getElementById('progressText');
      const confirmationModal = document.getElementById('confirmationModal');
      const finalScoreElement = document.getElementById('finalScore');
      const cancelSubmit = document.getElementById('cancelSubmit');
      const confirmSubmit = document.getElementById('confirmSubmit');

      const totalQuestions = {{ count($soal) }};
      let answeredQuestions = new Set();

      // Deteksi perubahan jawaban
      inputs.forEach(input => {
        input.addEventListener('input', () => {
          const id = input.dataset.questionId;
          if (input.type === 'radio') {
            if (input.checked) answeredQuestions.add(id);
          } else if (input.type === 'text') {
            if (input.value.trim() !== '') answeredQuestions.add(id);
            else answeredQuestions.delete(id);
          }

          const answeredCount = answeredQuestions.size;
          progressText.textContent = `${answeredCount}/${totalQuestions}`;
          progressBar.style.width = `${(answeredCount / totalQuestions) * 100}%`;

          // Aktifkan tombol submit jika semua sudah dijawab
          if (answeredCount === totalQuestions) {
            submitButton.disabled = false;
            submitButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
            submitButton.classList.add('bg-primary', 'cursor-pointer');
          } else {
            submitButton.disabled = true;
            submitButton.classList.add('bg-gray-400', 'cursor-not-allowed');
            submitButton.classList.remove('bg-primary', 'cursor-pointer');
          }
        });
      });

      // Saat klik submit form
      form.addEventListener('submit', function(e) {
        e.preventDefault(); // jangan kirim langsung

        let score = 0;

        inputs.forEach(input => {
          const correct = input.dataset.correctAnswer?.trim()?.toLowerCase();
          const type = input.dataset.questionType;
          const id = input.dataset.questionId;

          if (type === 'multiple_choice') {
            if (input.checked && input.value.trim().toLowerCase() === correct) {
              score++;
            }
          } else if (type === 'short_answer') {
            if (
              input.value.trim().toLowerCase() === correct
            ) {
              score++;
            }
          }
        });

        finalScoreElement.textContent = `${score} poin`;
        confirmationModal.classList.remove('hidden');
        confirmationModal.classList.add('flex');
      });

      // Batal kirim
      cancelSubmit.addEventListener('click', function() {
        confirmationModal.classList.add('hidden');
        confirmationModal.classList.remove('flex');
      });

      // Konfirmasi kirim
      confirmSubmit.addEventListener('click', function() {
        // Tambahkan input tersembunyi skor ke dalam form
        const inputSkor = document.createElement('input');
        inputSkor.type = 'hidden';
        inputSkor.name = 'skor';
        inputSkor.value = finalScoreElement.textContent.split(' ')[0]; // ambil angka saja
        form.appendChild(inputSkor);

        form.submit(); // submit ke controller
      });
    });
  </script>

</x-layout-web>
