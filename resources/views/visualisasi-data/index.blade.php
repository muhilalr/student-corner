<x-layout-web>
  <section class="bg-primary py-16 px-16 mb-10">
    <div class="flex flex-col items-center">
      <h1 class="mb-4 text-3xl font-bold text-white">
        Kalkulator Statistik
      </h1>
      <p class="mb-8 text-lg text-center text-white">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, dolorum debitis numquam laudantium
        perferendis magni explicabo voluptates, quia molestias cupiditate, aut maxime. Eos libero doloribus cumque
        impedit voluptas ipsum beatae.
      </p>
    </div>
  </section>

  <section class="bg-[#EEF0F2] text-black grid grid-cols-3 gap-7 px-20 mb-10">
    <a href="{{ route('visualisasi.histogram') }}" class="block">
      <div class="rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg mb-6 sm:mb-0">
        <div class="mb-4 flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-lg bg-yellow-400">
          <svg width="35" height="35" viewBox="0 0 100 100" fill="white" xmlns="http://www.w3.org/2000/svg">
            <rect x="10" y="60" width="15" height="30" rx="2" fill="white" />
            <rect x="35" y="40" width="15" height="50" rx="2" fill="white" />
            <rect x="60" y="20" width="15" height="70" rx="2" fill="white" />
          </svg>


        </div>
        <h3 class="mb-2 text-base sm:text-lg font-semibold text-gray-800">Histogram</h3>
        <p class="text-justify text-xs sm:text-sm text-gray-500">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam nesciunt quod qui! Reprehenderit maiores
          incidunt qui consectetur voluptatibus cum corrupti?
        </p>
      </div>
    </a>
  </section>
  <x-footer class="fill-[#EEF0F2]" />
</x-layout-web>
