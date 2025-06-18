<x-layout-web>
  <!-- Main Content -->
  <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <form id="quizForm" class="space-y-8">

      <!-- Question 1 -->
      <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden animate-fade-in">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white">
          <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
              <span class="text-sm font-bold">1</span>
            </div>
            <span class="text-blue-100 text-sm font-medium">Pertanyaan 1</span>
          </div>
          <h2 class="text-xl sm:text-2xl font-bold leading-tight">
            Apa yang dimaksud dengan mean dalam statistik deskriptif?
          </h2>
        </div>
        <div class="p-6 sm:p-8">
          <div class="space-y-4">
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-blue-300 hover:bg-blue-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_1" value="a"
                class="mt-1 w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">A.</span>
                <p class="text-gray-900 font-medium">Nilai tengah dari sekumpulan data yang telah diurutkan</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-blue-300 hover:bg-blue-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_1" value="b"
                class="mt-1 w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">B.</span>
                <p class="text-gray-900 font-medium">Rata-rata aritmatika dari sekumpulan data</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-blue-300 hover:bg-blue-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_1" value="c"
                class="mt-1 w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">C.</span>
                <p class="text-gray-900 font-medium">Nilai yang paling sering muncul dalam data</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-blue-300 hover:bg-blue-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_1" value="d"
                class="mt-1 w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">D.</span>
                <p class="text-gray-900 font-medium">Selisih antara nilai maksimum dan minimum</p>
              </div>
            </label>
          </div>
        </div>
      </div>

      <!-- Question 2 -->
      <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden animate-fade-in">
        <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-6 text-white">
          <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
              <span class="text-sm font-bold">2</span>
            </div>
            <span class="text-purple-100 text-sm font-medium">Pertanyaan 2</span>
          </div>
          <h2 class="text-xl sm:text-2xl font-bold leading-tight">
            Manakah yang merupakan ukuran pemusatan data?
          </h2>
        </div>
        <div class="p-6 sm:p-8">
          <div class="space-y-4">
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-purple-300 hover:bg-purple-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_2" value="a"
                class="mt-1 w-5 h-5 text-purple-600 border-gray-300 focus:ring-purple-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">A.</span>
                <p class="text-gray-900 font-medium">Varians</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-purple-300 hover:bg-purple-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_2" value="b"
                class="mt-1 w-5 h-5 text-purple-600 border-gray-300 focus:ring-purple-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">B.</span>
                <p class="text-gray-900 font-medium">Standar deviasi</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-purple-300 hover:bg-purple-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_2" value="c"
                class="mt-1 w-5 h-5 text-purple-600 border-gray-300 focus:ring-purple-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">C.</span>
                <p class="text-gray-900 font-medium">Median</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-purple-300 hover:bg-purple-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_2" value="d"
                class="mt-1 w-5 h-5 text-purple-600 border-gray-300 focus:ring-purple-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">D.</span>
                <p class="text-gray-900 font-medium">Range</p>
              </div>
            </label>
          </div>
        </div>
      </div>

      <!-- Question 3 -->
      <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden animate-fade-in">
        <div class="bg-gradient-to-r from-green-600 to-teal-600 p-6 text-white">
          <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
              <span class="text-sm font-bold">3</span>
            </div>
            <span class="text-green-100 text-sm font-medium">Pertanyaan 3</span>
          </div>
          <h2 class="text-xl sm:text-2xl font-bold leading-tight">
            Bagaimana cara menghitung modus dari data berkelompok?
          </h2>
        </div>
        <div class="p-6 sm:p-8">
          <div class="space-y-4">
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-green-300 hover:bg-green-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_3" value="a"
                class="mt-1 w-5 h-5 text-green-600 border-gray-300 focus:ring-green-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">A.</span>
                <p class="text-gray-900 font-medium">Menggunakan rumus interpolasi linear</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-green-300 hover:bg-green-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_3" value="b"
                class="mt-1 w-5 h-5 text-green-600 border-gray-300 focus:ring-green-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">B.</span>
                <p class="text-gray-900 font-medium">Mencari kelas dengan frekuensi tertinggi lalu menggunakan rumus
                  modus</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-green-300 hover:bg-green-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_3" value="c"
                class="mt-1 w-5 h-5 text-green-600 border-gray-300 focus:ring-green-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">C.</span>
                <p class="text-gray-900 font-medium">Menghitung rata-rata dari semua kelas</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-green-300 hover:bg-green-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_3" value="d"
                class="mt-1 w-5 h-5 text-green-600 border-gray-300 focus:ring-green-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">D.</span>
                <p class="text-gray-900 font-medium">Menggunakan nilai tengah dari setiap kelas</p>
              </div>
            </label>
          </div>
        </div>
      </div>

      <!-- Question 4 -->
      <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden animate-fade-in">
        <div class="bg-gradient-to-r from-orange-600 to-red-600 p-6 text-white">
          <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
              <span class="text-sm font-bold">4</span>
            </div>
            <span class="text-orange-100 text-sm font-medium">Pertanyaan 4</span>
          </div>
          <h2 class="text-xl sm:text-2xl font-bold leading-tight">
            Apa perbedaan antara varians dan standar deviasi?
          </h2>
        </div>
        <div class="p-6 sm:p-8">
          <div class="space-y-4">
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-orange-300 hover:bg-orange-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_4" value="a"
                class="mt-1 w-5 h-5 text-orange-600 border-gray-300 focus:ring-orange-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">A.</span>
                <p class="text-gray-900 font-medium">Tidak ada perbedaan, keduanya sama</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-orange-300 hover:bg-orange-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_4" value="b"
                class="mt-1 w-5 h-5 text-orange-600 border-gray-300 focus:ring-orange-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">B.</span>
                <p class="text-gray-900 font-medium">Standar deviasi adalah akar kuadrat dari varians</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-orange-300 hover:bg-orange-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_4" value="c"
                class="mt-1 w-5 h-5 text-orange-600 border-gray-300 focus:ring-orange-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">C.</span>
                <p class="text-gray-900 font-medium">Varians lebih besar dari standar deviasi</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-orange-300 hover:bg-orange-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_4" value="d"
                class="mt-1 w-5 h-5 text-orange-600 border-gray-300 focus:ring-orange-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">D.</span>
                <p class="text-gray-900 font-medium">Varians adalah kuadrat dari standar deviasi</p>
              </div>
            </label>
          </div>
        </div>
      </div>

      <!-- Question 5 -->
      <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden animate-fade-in">
        <div class="bg-gradient-to-r from-indigo-600 to-blue-600 p-6 text-white">
          <div class="flex items-center space-x-3 mb-4">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
              <span class="text-sm font-bold">5</span>
            </div>
            <span class="text-indigo-100 text-sm font-medium">Pertanyaan 5</span>
          </div>
          <h2 class="text-xl sm:text-2xl font-bold leading-tight">
            Dalam histogram, apa yang dimaksud dengan frekuensi relatif?
          </h2>
        </div>
        <div class="p-6 sm:p-8">
          <div class="space-y-4">
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-indigo-300 hover:bg-indigo-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_5" value="a"
                class="mt-1 w-5 h-5 text-indigo-600 border-gray-300 focus:ring-indigo-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">A.</span>
                <p class="text-gray-900 font-medium">Jumlah data dalam setiap kelas</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-indigo-300 hover:bg-indigo-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_5" value="b"
                class="mt-1 w-5 h-5 text-indigo-600 border-gray-300 focus:ring-indigo-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">B.</span>
                <p class="text-gray-900 font-medium">Perbandingan frekuensi kelas dengan total frekuensi</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-indigo-300 hover:bg-indigo-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_5" value="c"
                class="mt-1 w-5 h-5 text-indigo-600 border-gray-300 focus:ring-indigo-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">C.</span>
                <p class="text-gray-900 font-medium">Lebar interval kelas</p>
              </div>
            </label>
            <label
              class="flex items-start space-x-4 p-4 rounded-xl border-2 border-gray-200 hover:border-indigo-300 hover:bg-indigo-50 cursor-pointer transition-all duration-200 question-option">
              <input type="radio" name="question_5" value="d"
                class="mt-1 w-5 h-5 text-indigo-600 border-gray-300 focus:ring-indigo-500">
              <div class="flex-1">
                <span class="text-sm font-medium text-gray-500 mb-1 block">D.</span>
                <p class="text-gray-900 font-medium">Titik tengah setiap kelas</p>
              </div>
            </label>
          </div>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8 text-center animate-fade-in">
        <div class="max-w-md mx-auto">
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Selesai Mengerjakan?</h3>
          <p class="text-gray-600 mb-6">Pastikan semua jawaban sudah terisi sebelum mengirim kuis.</p>
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
  </main>

  <!-- Floating Help Button -->
  <div class="fixed bottom-6 right-6 z-50">
    <button
      class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white p-4 rounded-full shadow-lg transition-all duration-200 transform hover:scale-110 animate-pulse-slow">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
        </path>
      </svg>
    </button>
  </div>

  <!-- Scroll to Top Button -->
  <div class="fixed bottom-6 left-6 z-50">
    <button id="scrollToTop"
      class="bg-gray-800 hover:bg-gray-900 text-white p-3 rounded-full shadow-lg transition-all duration-200 transform hover:scale-110 opacity-0 invisible">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
      </svg>
    </button>
  </div>

  <script>
    // Enhanced interactivity
    const questionOptions = document.querySelectorAll('.question-option');
    const submitButton = document.getElementById('submitButton');
    const scrollToTopBtn = document.getElementById('scrollToTop');

    // Function to check if all questions are answered
    function checkAllAnswered() {
      const totalQuestions = 5;
      let answeredQuestions = 0;

      for (let i = 1; i <= totalQuestions; i++) {
        if (document.querySelector(`input[name="question_${i}"]:checked`)) {
          answeredQuestions++;
        }
      }

      if (answeredQuestions === totalQuestions) {
        submitButton.disabled = false;
        submitButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
        submitButton.classList.add('bg-gradient-to-r', 'from-green-600', 'to-emerald-600', 'hover:from-green-700',
          'hover:to-emerald-700', 'transform', 'hover:scale-105');
      } else {
        submitButton.disabled = true;
        submitButton.classList.add('bg-gray-400', 'cursor-not-allowed');
        submitButton.classList.remove('bg-gradient-to-r', 'from-green-600', 'to-emerald-600', 'hover:from-green-700',
          'hover:to-emerald-700', 'transform', 'hover:scale-105');
      }
    }

    // Handle option selection
    questionOptions.forEach(option => {
      const radio = option.querySelector('input[type="radio"]');

      option.addEventListener('click', function() {
        // Remove selected state from all options with same name
        const sameNameOptions = document.querySelectorAll(`input[name="${radio.name}"]`);
        sameNameOptions.forEach(r => {
          const label = r.closest('label');
          label.classList.remove('border-blue-500', 'bg-blue-50', 'border-purple-500', 'bg-purple-50',
            'border-green-500', 'bg-green-50', 'border-orange-500', 'bg-orange-50',
            'border-indigo-500', 'bg-indigo-50');
          label.classList.add('border-gray-200');
        });

        // Add selected state to clicked option
        if (radio.checked) {
          const questionCard = option.closest('.bg-white');
          const headerClasses = questionCard.querySelector('[class*="bg-gradient-to-r"]').className;

          if (headerClasses.includes('from-blue-600')) {
            option.classList.add('border-blue-500', 'bg-blue-50');
          } else if (headerClasses.includes('from-purple-600')) {
            option.classList.add('border-purple-500', 'bg-purple-50');
          } else if (headerClasses.includes('from-green-600')) {
            option.classList.add('border-green-500', 'bg-green-50');
          } else if (headerClasses.includes('from-orange-600')) {
            option.classList.add('border-orange-500', 'bg-orange-50');
          } else if (headerClasses.includes('from-indigo-600')) {
            option.classList.add('border-indigo-500', 'bg-indigo-50');
          }

          option.classList.remove('border-gray-200');
        }

        // Check if all questions are answered
        checkAllAnswered();
      });
    });

    // Handle form submission
    document.getElementById('quizForm').addEventListener('submit', function(e) {
      e.preventDefault();

      // Show confirmation
      if (confirm('Apakah Anda yakin ingin mengirim jawaban? Jawaban tidak dapat diubah setelah dikirim.')) {
        // Here you would normally submit to server
        alert('Jawaban berhasil dikirim! Terima kasih telah mengikuti kuis.');
        // For demo purposes, you could redirect or show results
      }
    });

    // Scroll to top functionality
    window.addEventListener('scroll', function() {
      if (window.pageYOffset > 300) {
        scrollToTopBtn.classList.remove('opacity-0', 'invisible');
        scrollToTopBtn.classList.add('opacity-100', 'visible');
      } else {
        scrollToTopBtn.classList.add('opacity-0', 'invisible');
        scrollToTopBtn.classList.remove('opacity-100', 'visible');
      }
    });

    scrollToTopBtn.addEventListener('click', function() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    // Animate elements on scroll
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observe all question cards
    document.querySelectorAll('.animate-fade-in').forEach((el, index) => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(30px)';
      el.style.transition = `opacity 0.6s ease-out ${index * 0.1}s, transform 0.6s ease-out ${index * 0.1}s`;
      observer.observe(el);
    });

    // Auto-save functionality (for better UX)
    const autoSave = () => {
      const formData = new FormData(document.getElementById('quizForm'));
      const answers = {};

      for (let [key, value] of formData.entries()) {
        answers[key] = value;
      }

      // Store in memory (in real Laravel app, you'd send to server)
      console.log('Auto-saved answers:', answers);
    };

    // Auto-save when answer changes
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
      radio.addEventListener('change', autoSave);
    });

    // Initial check on page load
    checkAllAnswered();
  </script>
</x-layout-web>
