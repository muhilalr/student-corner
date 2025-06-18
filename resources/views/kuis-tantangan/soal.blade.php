<x-layout-web>
  <!-- Main Content -->
  <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <form id="quizForm" class="space-y-8">
      @csrf
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
      const quizForm = document.getElementById('quizForm');
      const submitButton = document.getElementById('submitButton');
      const progressBar = document.getElementById('progressBar');
      const progressText = document.getElementById('progressText');
      const confirmationModal = document.getElementById('confirmationModal');
      const finalScoreSpan = document.getElementById('finalScore');
      const cancelSubmitBtn = document.getElementById('cancelSubmit');
      const confirmSubmitBtn = document.getElementById('confirmSubmit');

      const totalQuestions = {{ count($soal) }};
      let answeredQuestions = 0;
      let calculatedScore = 0;
      let userAnswers = {};

      // Fungsi untuk normalisasi jawaban (untuk isian singkat)
      function normalizeAnswer(answer) {
        return answer.toString().toLowerCase().trim();
      }

      // Fungsi untuk update progress dan check apakah semua soal sudah dijawab
      function updateProgress() {
        const answeredCount = Object.keys(userAnswers).length;
        answeredQuestions = answeredCount;

        // Update progress bar
        const progressPercent = (answeredCount / totalQuestions) * 100;
        progressBar.style.width = progressPercent + '%';
        progressText.textContent = answeredCount + '/' + totalQuestions;

        // Enable/disable submit button
        if (answeredCount === totalQuestions) {
          submitButton.disabled = false;
          submitButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
          submitButton.classList.add('bg-primary', 'hover:bg-primary/90', 'cursor-pointer');

          // Hitung skor
          calculateScore();
        } else {
          submitButton.disabled = true;
          submitButton.classList.add('bg-gray-400', 'cursor-not-allowed');
          submitButton.classList.remove('bg-primary', 'hover:bg-primary/90', 'cursor-pointer');
        }
      }

      // Fungsi untuk menghitung skor
      function calculateScore() {
        let score = 0;

        Object.keys(userAnswers).forEach(questionId => {
          const input = document.querySelector(`[data-question-id="${questionId}"]`);
          const questionType = input.getAttribute('data-question-type');
          const correctAnswer = input.getAttribute('data-correct-answer');
          const userAnswer = userAnswers[questionId];

          if (questionType === 'multiple_choice') {
            // Untuk pilihan ganda, langsung bandingkan
            if (userAnswer === correctAnswer) {
              score += 1;
            }
          } else if (questionType === 'short_answer') {
            // Untuk isian singkat, normalisasi dulu sebelum bandingkan
            if (normalizeAnswer(userAnswer) === normalizeAnswer(correctAnswer)) {
              score += 1;
            }
          }
        });

        calculatedScore = score;
        console.log('Skor yang dihitung:', calculatedScore);
        console.log('Detail jawaban:', userAnswers);
      }

      // Event listener untuk radio button (pilihan ganda)
      document.querySelectorAll('input[type="radio"].question-input').forEach(radio => {
        radio.addEventListener('change', function() {
          const questionId = this.getAttribute('data-question-id');
          const userAnswer = this.value;

          // Simpan jawaban user
          userAnswers[questionId] = userAnswer;

          // Update progress
          updateProgress();
        });
      });

      // Event listener untuk text input (isian singkat)
      document.querySelectorAll('input[type="text"].question-input').forEach(textInput => {
        // Debounce untuk input text
        let timeout;

        textInput.addEventListener('input', function() {
          clearTimeout(timeout);
          const questionId = this.getAttribute('data-question-id');
          const userAnswer = this.value.trim();

          timeout = setTimeout(() => {
            if (userAnswer !== '') {
              // Simpan jawaban user
              userAnswers[questionId] = userAnswer;
            } else {
              // Hapus jawaban jika kosong
              delete userAnswers[questionId];
            }

            // Update progress
            updateProgress();
          }, 500); // 500ms delay
        });

        // Event listener untuk blur (ketika user meninggalkan input)
        textInput.addEventListener('blur', function() {
          const questionId = this.getAttribute('data-question-id');
          const userAnswer = this.value.trim();

          if (userAnswer !== '') {
            userAnswers[questionId] = userAnswer;
          } else {
            delete userAnswers[questionId];
          }

          updateProgress();
        });
      });

      // Event listener untuk form submit
      quizForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Tampilkan modal konfirmasi dengan skor
        finalScoreSpan.textContent = calculatedScore + '/' + totalQuestions;
        confirmationModal.classList.remove('hidden');
        confirmationModal.classList.add('flex');
      });

      // Event listener untuk tombol batal di modal
      cancelSubmitBtn.addEventListener('click', function() {
        confirmationModal.classList.add('hidden');
        confirmationModal.classList.remove('flex');
      });

      // Event listener untuk tombol konfirmasi di modal
      confirmSubmitBtn.addEventListener('click', function() {
        // Siapkan data untuk dikirim ke controller
        const formData = new FormData();
        formData.append('_token', document.querySelector('input[name="_token"]').value);
        formData.append('skor', calculatedScore);
        formData.append('total_soal', totalQuestions);

        // Tambahkan jawaban user dengan detail tipe soal
        Object.keys(userAnswers).forEach(questionId => {
          const input = document.querySelector(`[data-question-id="${questionId}"]`);
          const questionType = input.getAttribute('data-question-type');

          formData.append('jawaban[' + questionId + '][answer]', userAnswers[questionId]);
          formData.append('jawaban[' + questionId + '][type]', questionType);
        });

        // Kirim data ke controller
        fetch('', {
            method: 'POST',
            body: formData,
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Redirect ke halaman hasil atau tampilkan pesan sukses
              window.location.href = data.redirect || '/quiz/result';
            } else {
              alert('Terjadi kesalahan: ' + data.message);
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim jawaban');
          })
          .finally(() => {
            confirmationModal.classList.add('hidden');
            confirmationModal.classList.remove('flex');
          });
      });

      // Tutup modal jika klik di luar modal
      confirmationModal.addEventListener('click', function(e) {
        if (e.target === confirmationModal) {
          confirmationModal.classList.add('hidden');
          confirmationModal.classList.remove('flex');
        }
      });
    });
  </script>
</x-layout-web>
