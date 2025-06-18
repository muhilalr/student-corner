<x-layout-web>
  <!-- Hero Section -->
  <section class="bg-primary text-white py-20">
    <div class="container mx-auto text-center px-4">
      <h1 class="text-5xl font-bold mb-4">Kuis & Tantangan Statistik</h1>
      <p class="text-xl text-blue-100">Uji pengetahuan statistik Anda dan raih peringkat tertinggi!</p>
    </div>
  </section>

  <!-- Kuis Reguler Section -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Kuis Reguler</h2>
        <p class="text-xl text-gray-600">Asah kemampuan statistik Anda dengan berbagai topik menarik</p>
      </div>
      <div class="splide mt-8 relative" aria-label="Splide Basic Example">
        <div class="splide__track mx-4 sm:mx-16 pb-10">
          <ul class="splide__list">
            @foreach ($kuis as $item)
              <li class="splide__slide px-2">
                <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-md flex flex-col h-full">
                  <img src="{{ asset('storage/' . $item->gambar) }}" alt="" width="500"
                    class="aspect-[3/2] rounded-lg object-cover" />
                  <h3 class="text-xl font-bold text-gray-800 my-2">{{ $item->judul }}</h3>
                  <p class="text-gray-600 font-semibold mb-4">
                    {{ Str::limit($item->deskripsi, 150, '...') }}</p>
                  <a href="{{ route('kuis-tantangan.soal', $item->slug) }}">
                    <button class="bg-primary w-full text-white px-4 py-2 rounded-lg hover:bg-[#00295A]">
                      Mulai
                    </button>
                  </a>
                </div>
              </li>
            @endforeach
          </ul>
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
      <div class="bg-gradient-to-r from-orange-400 to-red-500 rounded-3xl p-8 mb-8 text-white relative overflow-hidden">
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
