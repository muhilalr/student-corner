<x-layout-web>
  <!-- Hero Section -->
  <section class="gradient-bg text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="container mx-auto px-4 relative z-10">
      <div class="text-center">
        <div class="floating inline-block mb-6">
          <i class="fas fa-brain text-6xl text-yellow-300"></i>
        </div>
        <h1 class="text-5xl font-bold mb-4">Kuis & Tantangan Statistik</h1>
        <p class="text-xl mb-8 opacity-90">Uji pengetahuan statistik Anda dan raih peringkat tertinggi!</p>
        <div class="flex justify-center space-x-4">
          <button
            class="bg-white text-purple-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition duration-300 shadow-lg">
            <i class="fas fa-play mr-2"></i>Mulai Kuis
          </button>
          <button
            class="glass-effect text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:bg-opacity-20 transition duration-300">
            <i class="fas fa-trophy mr-2"></i>Lihat Peringkat
          </button>
        </div>
      </div>
    </div>
    <!-- Floating Elements -->
    <div class="absolute top-20 left-10 opacity-30">
      <i class="fas fa-chart-bar text-4xl floating" style="animation-delay: 0.5s;"></i>
    </div>
    <div class="absolute bottom-20 right-10 opacity-30">
      <i class="fas fa-calculator text-4xl floating" style="animation-delay: 1s;"></i>
    </div>
  </section>

  <!-- Stats Overview -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="text-center">
          <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-question-circle text-2xl text-blue-600"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-800 mb-2">1,250+</h3>
          <p class="text-gray-600">Soal Tersedia</p>
        </div>
        <div class="text-center">
          <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-users text-2xl text-green-600"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-800 mb-2">5,480</h3>
          <p class="text-gray-600">Peserta Aktif</p>
        </div>
        <div class="text-center">
          <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-fire text-2xl text-yellow-600"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-800 mb-2">32</h3>
          <p class="text-gray-600">Tantangan Selesai</p>
        </div>
        <div class="text-center">
          <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-medal text-2xl text-purple-600"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-800 mb-2">890</h3>
          <p class="text-gray-600">Skor Tertinggi</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Kuis Reguler Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Kuis Reguler</h2>
        <p class="text-xl text-gray-600">Asah kemampuan statistik Anda dengan berbagai topik menarik</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Kuis Card 1 -->
        <div class="bg-white rounded-2xl shadow-lg card-hover overflow-hidden">
          <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 relative">
            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
            <div class="absolute bottom-4 left-4 text-white">
              <i class="fas fa-chart-line text-3xl"></i>
            </div>
            <div class="absolute top-4 right-4">
              <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">Populer</span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Statistik Deskriptif</h3>
            <p class="text-gray-600 mb-4">Pelajari mean, median, modus, dan ukuran pemusatan data lainnya</p>
            <div class="flex items-center justify-between mb-4">
              <span class="text-sm text-gray-500">
                <i class="fas fa-clock mr-1"></i>15 menit
              </span>
              <span class="text-sm text-gray-500">
                <i class="fas fa-question mr-1"></i>20 soal
              </span>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <div class="flex text-yellow-400">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <span class="text-sm text-gray-600 ml-2">(4.8)</span>
              </div>
              <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Mulai
              </button>
            </div>
          </div>
        </div>

        <!-- Kuis Card 2 -->
        <div class="bg-white rounded-2xl shadow-lg card-hover overflow-hidden">
          <div class="h-48 bg-gradient-to-br from-green-400 to-green-600 relative">
            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
            <div class="absolute bottom-4 left-4 text-white">
              <i class="fas fa-chart-pie text-3xl"></i>
            </div>
            <div class="absolute top-4 right-4">
              <span class="bg-green-400 text-green-900 px-3 py-1 rounded-full text-sm font-semibold">Baru</span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Probabilitas Dasar</h3>
            <p class="text-gray-600 mb-4">Konsep dasar peluang dan distribusi probabilitas</p>
            <div class="flex items-center justify-between mb-4">
              <span class="text-sm text-gray-500">
                <i class="fas fa-clock mr-1"></i>20 menit
              </span>
              <span class="text-sm text-gray-500">
                <i class="fas fa-question mr-1"></i>25 soal
              </span>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <div class="flex text-yellow-400">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="far fa-star"></i>
                </div>
                <span class="text-sm text-gray-600 ml-2">(4.5)</span>
              </div>
              <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                Mulai
              </button>
            </div>
          </div>
        </div>

        <!-- Kuis Card 3 -->
        <div class="bg-white rounded-2xl shadow-lg card-hover overflow-hidden">
          <div class="h-48 bg-gradient-to-br from-purple-400 to-purple-600 relative">
            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
            <div class="absolute bottom-4 left-4 text-white">
              <i class="fas fa-chart-bar text-3xl"></i>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Inferensi Statistik</h3>
            <p class="text-gray-600 mb-4">Uji hipotesis, interval kepercayaan, dan estimasi parameter</p>
            <div class="flex items-center justify-between mb-4">
              <span class="text-sm text-gray-500">
                <i class="fas fa-clock mr-1"></i>30 menit
              </span>
              <span class="text-sm text-gray-500">
                <i class="fas fa-question mr-1"></i>30 soal
              </span>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <div class="flex text-yellow-400">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <span class="text-sm text-gray-600 ml-2">(4.9)</span>
              </div>
              <button
                class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition duration-300">
                Mulai
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Tantangan Bulanan Section -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Tantangan Bulanan</h2>
        <p class="text-xl text-gray-600">Kompetisi bulanan dengan hadiah menarik menanti Anda!</p>
      </div>

      <!-- Current Challenge -->
      <div
        class="bg-gradient-to-r from-orange-400 to-red-500 rounded-3xl p-8 mb-8 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white bg-opacity-10 rounded-full -ml-12 -mb-12"></div>
        <div class="relative z-10">
          <div class="flex items-center justify-between mb-6">
            <div>
              <h3 class="text-3xl font-bold mb-2">Tantangan Juni 2025</h3>
              <p class="text-lg opacity-90">Statistik Lanjutan & Analisis Data</p>
            </div>
            <div class="text-right">
              <div class="bg-white bg-opacity-20 px-4 py-2 rounded-full">
                <i class="fas fa-trophy text-2xl pulse-animation"></i>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white bg-opacity-20 rounded-lg p-4">
              <div class="flex items-center">
                <i class="fas fa-calendar-alt text-2xl mr-3"></i>
                <div>
                  <p class="text-sm opacity-80">Berakhir dalam</p>
                  <p class="text-xl font-bold">12 hari</p>
                </div>
              </div>
            </div>
            <div class="bg-white bg-opacity-20 rounded-lg p-4">
              <div class="flex items-center">
                <i class="fas fa-users text-2xl mr-3"></i>
                <div>
                  <p class="text-sm opacity-80">Peserta</p>
                  <p class="text-xl font-bold">2,340</p>
                </div>
              </div>
            </div>
            <div class="bg-white bg-opacity-20 rounded-lg p-4">
              <div class="flex items-center">
                <i class="fas fa-gift text-2xl mr-3"></i>
                <div>
                  <p class="text-sm opacity-80">Hadiah Utama</p>
                  <p class="text-xl font-bold">Rp 1,000,000</p>
                </div>
              </div>
            </div>
          </div>
          <button
            class="bg-white text-orange-600 px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition duration-300 shadow-lg">
            <i class="fas fa-bolt mr-2"></i>Ikut Tantangan Sekarang
          </button>
        </div>
      </div>

      <!-- Previous Challenges -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-gray-100 rounded-2xl p-6">
          <div class="flex items-center mb-4">
            <div class="bg-gray-300 w-12 h-12 rounded-full flex items-center justify-center mr-4">
              <i class="fas fa-check text-gray-600"></i>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-800">Tantangan Mei 2025</h4>
              <p class="text-gray-600">Selesai • 1,890 peserta</p>
            </div>
          </div>
          <p class="text-gray-700 mb-4">Regresi Linear dan Korelasi Data</p>
          <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">Pemenang: Ahmad Rizki (950 poin)</span>
            <button class="text-blue-600 hover:text-blue-800 transition duration-300">
              Lihat Hasil
            </button>
          </div>
        </div>

        <div class="bg-gray-100 rounded-2xl p-6">
          <div class="flex items-center mb-4">
            <div class="bg-gray-300 w-12 h-12 rounded-full flex items-center justify-center mr-4">
              <i class="fas fa-check text-gray-600"></i>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-800">Tantangan April 2025</h4>
              <p class="text-gray-600">Selesai • 2,150 peserta</p>
            </div>
          </div>
          <p class="text-gray-700 mb-4">Distribusi Normal dan Standardisasi</p>
          <div class="flex items-center justify-between">
            <span class="text-sm text-gray-600">Pemenang: Sari Indah (925 poin)</span>
            <button class="text-blue-600 hover:text-blue-800 transition duration-300">
              Lihat Hasil
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Leaderboard Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Papan Peringkat</h2>
        <p class="text-xl text-gray-600">Para ahli statistik terbaik bulan ini</p>
      </div>

      <div class="max-w-4xl mx-auto">
        <!-- Top 3 -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <!-- 2nd Place -->
          <div class="bg-white rounded-2xl p-6 text-center card-hover order-2 md:order-1">
            <div class="relative inline-block mb-4">
              <img src="https://images.unsplash.com/photo-1494790108755-2616b60f-3274?w=80&h=80&fit=crop&crop=face"
                alt="2nd Place" class="w-20 h-20 rounded-full mx-auto object-cover">
              <div
                class="absolute -top-2 -right-2 bg-gray-400 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                2
              </div>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-1">Maria Santos</h3>
            <p class="text-gray-600 mb-2">Mahasiswa Statistika</p>
            <p class="text-2xl font-bold text-gray-600">875 poin</p>
          </div>

          <!-- 1st Place -->
          <div
            class="bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl p-6 text-center card-hover text-white order-1 md:order-2 transform md:scale-105">
            <div class="relative inline-block mb-4">
              <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=80&h=80&fit=crop&crop=face"
                alt="1st Place" class="w-24 h-24 rounded-full mx-auto object-cover">
              <div
                class="absolute -top-2 -right-2 bg-yellow-300 text-yellow-800 w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold">
                <i class="fas fa-crown"></i>
              </div>
            </div>
            <h3 class="text-2xl font-bold mb-1">Ahmad Rizki</h3>
            <p class="text-yellow-100 mb-2">Data Scientist</p>
            <p class="text-3xl font-bold">950 poin</p>
            <div class="mt-4">
              <i class="fas fa-trophy text-2xl pulse-animation"></i>
            </div>
          </div>

          <!-- 3rd Place -->
          <div class="bg-white rounded-2xl p-6 text-center card-hover order-3">
            <div class="relative inline-block mb-4">
              <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=80&h=80&fit=crop&crop=face"
                alt="3rd Place" class="w-20 h-20 rounded-full mx-auto object-cover">
              <div
                class="absolute -top-2 -right-2 bg-orange-400 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                3
              </div>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-1">Lisa Chen</h3>
            <p class="text-gray-600 mb-2">Peneliti</p>
            <p class="text-2xl font-bold text-orange-600">820 poin</p>
          </div>
        </div>

        <!-- Remaining Rankings -->
        <div class="bg-white rounded-2xl shadow-lg">
          <div class="p-6 border-b">
            <h3 class="text-xl font-bold text-gray-800">Peringkat Lengkap</h3>
          </div>
          <div class="divide-y">
            <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition duration-300">
              <div class="flex items-center">
                <span
                  class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-sm font-bold text-gray-600 mr-4">4</span>
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop&crop=face"
                  alt="User" class="w-10 h-10 rounded-full mr-3 object-cover">
                <div>
                  <p class="font-semibold text-gray-800">David Kumar</p>
                  <p class="text-sm text-gray-600">Analyst</p>
                </div>
              </div>
              <span class="text-lg font-bold text-gray-800">785 poin</span>
            </div>
            <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition duration-300">
              <div class="flex items-center">
                <span
                  class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-sm font-bold text-gray-600 mr-4">5</span>
                <img src="https://images.unsplash.com/photo-1554151228-14d9def656e4?w=40&h=40&fit=crop&crop=face"
                  alt="User" class="w-10 h-10 rounded-full mr-3 object-cover">
                <div>
                  <p class="font-semibold text-gray-800">Nina Putri</p>
                  <p class="text-sm text-gray-600">Mahasiswa</p>
                </div>
              </div>
              <span class="text-lg font-bold text-gray-800">750 poin</span>
            </div>
            <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition duration-300">
              <div class="flex items-center">
                <span
                  class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-sm font-bold text-gray-600 mr-4">6</span>
                <img src="https://images.unsplash.com/photo-1599566150163-29194dcaad36?w=40&h=40&fit=crop&crop=face"
                  alt="User" class="w-10 h-10 rounded-full mr-3 object-cover">
                <div>
                  <p class="font-semibold text-gray-800">Budi Santoso</p>
                  <p class="text-sm text-gray-600">Professor</p>
                </div>
              </div>
              <span class="text-lg font-bold text-gray-800">720 poin</span>
            </div>
          </div>
          <div class="p-6 text-center border-t">
            <button class="text-blue-600 hover:text-blue-800 font-semibold transition duration-300">
              Lihat Semua Peringkat
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-4xl font-bold mb-4">Siap Menjadi Master Statistik?</h2>
      <p class="text-xl mb-8 opacity-90">Bergabunglah dengan ribuan pengguna lain dan tingkatkan kemampuan statistik
        Anda!</p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <button
          class="bg-white text-blue-600 px-8 py-4 rounded-full font-bold hover:bg-gray-100 transition duration-300 shadow-lg">
          <i class="fas fa-rocket mr-2"></i>Mulai Sekarang
        </button>
        <button
          class="glass-effect text-white px-8 py-4 rounded-full font-bold hover:bg-white hover:bg-opacity-20 transition duration-300">
          <i class="fas fa-info-circle mr-2"></i>Pelajari Lebih Lanjut
        </button>
      </div>
    </div>
  </section>

  <script>
    // Simple animations and interactions
    document.addEventListener('DOMContentLoaded', function() {
      // Smooth scrolling for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          e.preventDefault();
          document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
          });
        });
      });

      // Counter animation for stats
      const counters = document.querySelectorAll('.text-3xl');
      counters.forEach(counter => {
        const target = parseInt(counter.textContent.replace(/[^0-9]/g, ''));
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
          current += increment;
          if (current >= target) {
            current = target;
            clearInterval(timer);
          }
          counter.textContent = Math.floor(current).toLocaleString() + (counter.textContent.includes('+') ?
            '+' : '');
        }, 20);
      });
    });
  </script>
</x-layout-web>
