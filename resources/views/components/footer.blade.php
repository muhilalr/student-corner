<!-- Footer -->
<footer class="relative bg-primary pt-16 pb-2">
  <!-- Curve top shape -->
  <div class="absolute top-0 right-0 left-0">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" class="w-full">
      <path d="M0,0 C480,100 960,100 1440,0 L1440,0 L0,0 Z" {{ $attributes->merge(['class' => '']) }}></path>
    </svg>
  </div>

  <!-- Main footer content -->
  <div class="container mx-auto px-10 lg:px-20 pt-14">
    <div class="flex flex-col md:flex-row items-center md:items-start justify-center md:justify-between gap-8 md:gap-0">
      <!-- Brand section -->
      <div class="flex flex-col w-full gap-7">
        <div class="w-full flex items-center justify-center md:justify-start gap-5">
          <img src="{{ asset('/gambar/logo-bps.jpg') }}" alt="">
          <h1 class="text-lg font-bold text-white">BADAN PUSAT STATISTIK <br>PROVINSI KEP. BANGKA <br>BELITUNG
          </h1>
        </div>
        <div class="flex flex-col md:flex-row justify-between gap-7">
          <div>
            <p class="text-base text-center md:text-left font-semibold text-gray-300">
              Badan Pusat Statistik Provinsi Kepulauan Bangka <br>
              Belitung <br>
              (BPS-Statistics Kepulauan Bangka Belitung) <br>
              Komplek Perkantoran Terpadu Pemerintah <br>
              Provinsi Kepulauan Bangka Belitung <br>
              Telp: (0717) 439422 <br>
              Mailbox: bps1900@bps.go.id <br>
            </p>
            <div class="mt-6 flex justify-center md:justify-start space-x-3">
              <a href="#">
                <img src="{{ asset('/gambar/facebook.svg') }}" alt="" width="50">
              </a>
              <a href="#">
                <img src="{{ asset('/gambar/instagram.svg') }}" alt="" width="50">
              </a>
              <a href="#">
                <img src="{{ asset('/gambar/twitter.svg') }}" alt="" width="50">
              </a>
              <a href="#">
                <img src="{{ asset('/gambar/youtube.svg') }}" alt="" width="50">
              </a>
            </div>
          </div>
          <div class="flex flex-col md:flex-row gap-10">
            <div>
              <h3 class="mb-4 font-semibold text-white">Tentang Kami</h3>
              <ul class="space-y-2">
                <li><a href="#" class="text-base text-gray-300 hover:text-white">Profil BPS</a></li>
                <li><a href="#" class="text-base text-gray-300 hover:text-white">PPID</a></li>
                <li><a href="#" class="text-base text-gray-300 hover:text-white">Kebijakan Diseminasi</a>
                </li>
              </ul>
            </div>
            <div>
              <h3 class="mb-4 font-semibold text-white">Tautan Lainnya</h3>
              <ul class="space-y-2">
                <li><a href="#" class="text-base text-gray-300 hover:text-white">ASEAN Stats</a></li>
                <li><a href="#" class="text-base text-gray-300 hover:text-white">Forum Masyarakat Statistik</a>
                </li>
                <li><a href="#" class="text-base text-gray-300 hover:text-white">Reformasi Birokrasi</a>
                </li>
                <li><a href="#" class="text-base text-gray-300 hover:text-white">Layanan Pengadaan Secara
                    Elektronik</a>
                </li>
                <li><a href="#" class="text-base text-gray-300 hover:text-white">Politeknik Statistika STIS</a>
                </li>
                <li><a href="#" class="text-base text-gray-300 hover:text-white">Pusdiklat BPS</a>
                </li>
                <li><a href="#" class="text-base text-gray-300 hover:text-white">JDIH BPS</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- Social media icons -->

      </div>
    </div>

    <!-- Bottom logo and copyright -->
    <div class="mt-12 mb-4 flex items-center justify-center">
      <p class="text-lg font-medium text-white">Hak Cipta © 2023 Badan Pusat Statistik</p>
    </div>
  </div>
</footer>
<!-- Akhir Footer -->
