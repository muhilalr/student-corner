<x-layout-web>
  <section class="bg-primary py-16 px-16 mb-10">
    <div class="flex flex-col items-center">
      <h1 class="mb-4 text-3xl font-bold text-white">
        Kalkulator Statistik
      </h1>
      <p class="mb-8 text-base text-center text-white">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, dolorum debitis numquam laudantium
        perferendis magni explicabo voluptates, quia molestias cupiditate, aut maxime. Eos libero doloribus cumque
        impedit voluptas ipsum beatae.
      </p>
    </div>
  </section>

  <section class="bg-[#EEF0F2] text-black grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 lg:gap-7 px-20 mb-10">
    <a href="{{ route('kalkulator-statistik.mean') }}" class="block">
      <div class="rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg mb-6 sm:mb-0">
        <div class="mb-4 flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-lg bg-yellow-400">
          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
            <!-- Garis bar di atas huruf x -->
            <line x1="8" y1="6" x2="16" y2="6" stroke="white" stroke-width="2" />
            <!-- Huruf x -->
            <text x="6" y="20" font-size="18" font-family="Arial" fill="white">x</text>
          </svg>

        </div>
        <h3 class="mb-2 text-lg font-semibold text-gray-800">Mean, Median, Modus</h3>
        <p class="text-justify text-sm text-gray-500">
          Kalkulator mean, median, dan modus dalam statistik. Kalkulator ini untuk menghitung mean, median, modus dari
          himpunan data.
        </p>
      </div>
    </a>
    <a href="{{ route('kalkulator-statistik.standar-deviasi') }}" class="block">
      <div class="rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg mb-6 sm:mb-0">
        <div class="mb-4 flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-lg bg-green-400">
          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
            <text x="4" y="20" font-size="25" font-family="Arial" fill="white">σ</text>
          </svg>
        </div>
        <h3 class="mb-2 text-lg font-semibold text-gray-800">Standard Deviasi</h3>
        <p class="text-justify text-sm text-gray-500">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt.
        </p>
      </div>
    </a>
    <a href="{{ route('kalkulator-statistik.kombinasi') }}" class="block">
      <div class="rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg mb-6 sm:mb-0">
        <div class="mb-4 flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-lg bg-purple-400">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white">
            <!-- Body kalkulator -->
            <rect x="4" y="2" width="16" height="20" rx="2" ry="2" stroke="white"
              stroke-width="2" fill="none" />

            <!-- Layar kalkulator -->
            <rect x="7" y="4" width="10" height="4" fill="white" />

            <!-- Tombol-tombol -->
            <circle cx="8" cy="10" r="1.2" fill="white" />
            <circle cx="12" cy="10" r="1.2" fill="white" />
            <circle cx="16" cy="10" r="1.2" fill="white" />

            <circle cx="8" cy="14" r="1.2" fill="white" />
            <circle cx="12" cy="14" r="1.2" fill="white" />
            <circle cx="16" cy="14" r="1.2" fill="white" />

            <circle cx="8" cy="18" r="1.2" fill="white" />
            <circle cx="12" cy="18" r="1.2" fill="white" />
            <circle cx="16" cy="18" r="1.2" fill="white" />
          </svg>

        </div>
        <h3 class="mb-2 text-lg font-semibold text-gray-800">Kombinasi</h3>
        <p class="text-justify text-sm text-gray-500">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt.
        </p>
      </div>
    </a>
  </section>
  <x-footer class="fill-[#EEF0F2]" />
</x-layout-web>
