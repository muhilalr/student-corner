<x-layout-web>
  <section class="bg-primary py-16 px-16 mb-10">
    <div class="flex flex-col items-center">
      <h1 class="mb-4 text-3xl font-bold text-white">
        Simulasi Statistik
      </h1>
      <p class="mb-8 text-base text-center text-white">
        Buat dan jalankan simulasi statistik untuk memprediksi hasil dan memahami dinamika data dalam berbagai
        skenario.
      </p>
    </div>
  </section>

  <section class="bg-[#EEF0F2] text-black grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 lg:gap-7 px-20 mb-10">
    <a href="{{ route('simulasi.sampling') }}" class="block">
      <div class="rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg mb-6 sm:mb-0">
        <div class="mb-4 flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-lg bg-yellow-400">
          <svg viewBox="0 0 600 300" xmlns="http://www.w3.org/2000/svg">
            <!-- Axis -->
            <line x1="0" y1="250" x2="600" y2="250" stroke="#999" stroke-width="1.5" />

            <!-- Population distribution (putih transparan) -->
            <path d="M 50 250 Q 150 50 250 250 T 450 250" fill="rgba(255, 255, 255, 0.2)" stroke="white"
              stroke-width="2" />
            <text x="120" y="40" fill="white" font-size="14">Distribusi Populasi</text>

            <!-- Sampling distribution (lebih sempit) -->
            <path d="M 200 250 Q 300 120 400 250" fill="rgba(255, 255, 255, 0.2)" stroke="white" stroke-width="2" />
            <text x="250" y="110" fill="white" font-size="14">Distribusi Rata-rata Sampel</text>

            <!-- Labels -->
            <text x="50" y="270" font-size="12" fill="white">x̄ rendah</text>
            <text x="500" y="270" font-size="12" fill="white">x̄ tinggi</text>
          </svg>
        </div>
        <h3 class="mb-2 text-lg font-semibold text-gray-800">Simulasi Random Sampling</h3>
        <p class="text-justify text-sm text-gray-500">
          Jalankan simulasi pengambilan sampel acak untuk memahami bagaimana sampel merepresentasikan populasi dan
          pengaruhnya terhadap analisis data.
        </p>
      </div>
    </a>
  </section>
  <x-footer class="fill-[#EEF0F2]" />
</x-layout-web>
