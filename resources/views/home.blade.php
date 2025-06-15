<x-layout-web>
  <!-- Hero Section -->
  <section class="bg-white">
    <div class="container mx-auto py-8 sm:py-12 px-4 sm:pr-6 sm:pl-16">
      <div class="flex flex-col items-center md:flex-row">
        <!-- Left Content -->
        <div data-aos="fade-right" data-aos-duration="1000" class="mb-10 w-full text-center md:text-left md:mb-0 md:w-1/2">
          <h1 class="mb-4 text-3xl sm:text-4xl md:text-5xl font-bold text-primary">
            Tempat Asyik Untuk
            <br />Literasi Statistik
          </h1>
          <p class="mb-8 text-base sm:text-lg text-gray-600">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa temporibus maiores possimus quisquam
            recusandae ipsum accusamus
            molestiae? Neque debitis repudiandae magnam quaerat, ut sint beatae?
          </p>
        </div>

        <!-- Right Content - Illustration -->
        <div data-aos="fade-left" data-aos-duration="1500" class="relative w-full md:w-1/2">
          <!-- Orange Circle Background -->
          <div class="absolute -top-6 -right-6 h-40 w-40 sm:h-64 sm:w-64 rounded-full bg-orange-100 opacity-50"></div>

          <!-- Small Decoration Elements -->
          <div class="absolute top-12 left-12 h-4 w-4 rounded-full bg-orange-200 hidden sm:block"></div>
          <div class="absolute bottom-24 left-6 h-6 w-6 rounded-full bg-orange-200 hidden sm:block"></div>
          <div class="absolute top-32 right-12 h-3 w-3 rounded-full bg-orange-200 hidden sm:block"></div>

          <!-- Yellow Circle -->
          <div
            class="absolute top-6 right-6 h-8 w-8 items-center justify-center rounded-full bg-yellow-200 hidden sm:flex">
            <div class="h-6 w-6 rounded-full bg-yellow-300"></div>
          </div>

          <!-- Main Illustration (People on bean bags) -->
          <div class="relative z-10 flex justify-center">
            <img src="{{ asset('gambar/home/Analysis-cuate.svg') }}" alt="Ilustrasi"
              class="w-64 sm:w-80 md:w-96 lg:w-full max-w-md" />
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End of Hero Section -->

  <!-- Section Konten Edukasi -->
  <section class="w-full bg-primary py-8 sm:py-16">
    <div data-aos="fade-up" data-aos-duration="1500" class="mx-auto max-w-6xl px-4">
      <!-- Section Heading -->
      <div class="mb-8 sm:mb-12 text-center">
        <h1 class="mb-2 text-2xl font-bold text-white">Konten Edukasi</h1>
        <p class="mx-auto max-w-xl text-base  text-slate-300">
          Eksplor dan pelajari lebih banyak berdasarkan topik yang kamu inginkan
        </p>
      </div>

      <!-- Services Cards Grid -->
      <div class="splide mt-8 relative" aria-label="Splide Basic Example">
        <div class="splide__track mx-4 sm:mx-16 pb-10">
          <ul class="splide__list">
            @foreach ($subjek_materi as $item)
              <li class="splide__slide px-2">
                <!-- SEO Services Card -->
                <div
                  class="rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg flex flex-col h-full">
                  <img src="{{ asset('storage/' . $item->gambar) }}" alt="" width="500"
                    class="aspect-[3/2] rounded-lg object-cover" />
                  <h3 class="mt-4 mb-2 text-base sm:text-lg font-semibold text-gray-800">{{ $item->judul }}</h3>
                  <p class="mb-3 text-justify text-xs sm:text-sm text-gray-500">
                    {{ Str::limit($item->deskripsi, 100, '...') }}
                  </p>
                  <a href="{{ route('konten-edukasi.show', $item->slug) }}">
                    <button
                      class="rounded-md bg-button hover:bg-[#02a66b] px-3 py-1 sm:px-4 sm:py-2 text-xs sm:text-sm font-medium text-white">Pelajari
                      Selengkapnya</button>
                  </a>
                </div>
              </li>
            @endforeach

          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- Akhir Section Konten Edukasi -->

  <!-- Section Alat Interaktif -->
  <section class="w-full bg-[#EEF0F2] pt-8 sm:pt-16">
    <div data-aos="fade-up" data-aos-duration="1500" class="mx-auto max-w-6xl px-4 sm:px-10">
      <!-- Section Heading -->
      <div class="mb-8 sm:mb-12 text-center">
        <h2 class="mb-2 text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800">Alat Bantu Interaktif</h2>
        <p class="mx-auto max-w-xl text-xs sm:text-sm text-gray-500">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus sapiente optio
        </p>
      </div>

      <!-- Services Cards Grid -->
      <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
        <!-- SEO Services Card -->
        <a href="{{ route('kalkulator-statistik.index') }}" class="w-full sm:w-auto">
          <div
            class="rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg mb-6 sm:mb-0">
            <div class="mb-4 flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-lg bg-yellow-400">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: rgba(255, 255, 255, 1)">
                <path
                  d="M19 2H5c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zM5 20V4h14l.001 16H5z">
                </path>
                <path d="M7 12h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zM7 6h10v4H7zm4 10h2v2h-2zm4-4h2v6h-2z"></path>
              </svg>
            </div>
            <h3 class="mb-2 text-base sm:text-lg font-semibold text-gray-800">Kalkulator Statistik</h3>
            <p class="text-justify text-xs sm:text-sm text-gray-500">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt.
            </p>
          </div>
        </a>
        <!-- Marketing Card -->
        <a href="{{ route('visualisasi.index') }}">
          <div
            class="w-full sm:w-auto rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg mb-6 sm:mb-0">
            <div class="mb-4 flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-lg bg-green-400">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="fill: rgba(255, 255, 255, 1)">
                <path
                  d="M13 2.051V11h8.949c-.47-4.717-4.232-8.479-8.949-8.949zm4.969 17.953c2.189-1.637 3.694-4.14 3.98-7.004h-8.183l4.203 7.004z">
                </path>
                <path
                  d="M11 12V2.051C5.954 2.555 2 6.824 2 12c0 5.514 4.486 10 10 10a9.93 9.93 0 0 0 4.255-.964s-5.253-8.915-5.254-9.031A.02.02 0 0 0 11 12z">
                </path>
              </svg>
            </div>
            <h3 class="mb-2 text-base sm:text-lg font-semibold text-gray-800">Visualisasi Data</h3>
            <p class="text-justify text-xs sm:text-sm text-gray-500">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt.
            </p>
          </div>
        </a>
        <!-- Viral Campaign Card -->
        <div
          class="w-full sm:w-auto rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg">
          <div class="mb-4 flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-lg bg-purple-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-white" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </div>
          <h3 class="mb-2 text-base sm:text-lg font-semibold text-gray-800">Simulasi Statistik</h3>
          <p class="text-justify text-xs sm:text-sm text-gray-500">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt.
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- Akhir Section Alat Interaktif -->

  <!-- Section kuis dan tantangan -->
  <section class="flex min-h-screen items-center justify-center bg-[#EEF0F2]">
    <div class="flex w-full max-w-6xl flex-col overflow-hidden rounded-xl bg-white shadow-lg md:flex-row">
      <!-- Left side - Illustration -->
      <div class="relative flex w-full items-center justify-center bg-primary p-6 md:w-1/2">
        <img src="{{ asset('gambar/home/Yes or no-amico.svg') }}" alt="" data-aos="fade-up"
          data-aos-duration="1500" class="w-48 sm:w-64 md:w-80 lg:w-96" />
      </div>

      <!-- Right side - Content -->
      <div data-aos="fade-up" data-aos-duration="1500"
        class="flex w-full flex-col items-center justify-center gap-4 sm:gap-5 p-4 sm:p-8 md:w-1/2">
        <div class="mb-2 sm:mb-4">
          <h1 class="mb-2 sm:mb-4 text-xl sm:text-2xl md:text-3xl font-bold text-gray-800">Kuis dan Tantangan Untuk
            Kamu!</h1>
          <p class="text-justify text-xs sm:text-sm text-gray-600">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Id accusantium repudiandae cumque quidem natus ex,
            voluptatem ea
            ipsam illo optio error voluptates laudantium nam harum porro nemo non perferendis veritatis ipsum. Ea
            laboriosam vitae saepe
            in commodi at modi, quia nostrum quaerat dolorem asperiores totam incidunt voluptates natus cum recusandae.
          </p>
        </div>
        <!-- Buttons -->
        <div class="w-full">
          <a href="{{ route('kuis-tantangan.index') }}">
            <button
              class="rounded-md border border-orange-500 px-3 py-1 sm:px-4 sm:py-2 text-xs sm:text-sm font-medium text-orange-500 transition-colors duration-300 hover:bg-orange-500 hover:text-white">
              Read more
            </button>
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- Akhir Section kuis dan tantangan -->

  <!-- Section Magang -->
  <section class=" bg-white ">
    <div class="flex flex-col md:flex-row min-h-screen items-center justify-center px-4">
      <!-- Left side illustration (only visible on larger screens) -->
      <div data-aos="fade-up" data-aos-duration="1500"
        class="hidden md:flex items-center justify-center rounded-md w-full md:w-1/2">
        <img src="{{ asset('gambar/home/Analysis-pana.svg') }}" alt=""
          class="w-64 sm:w-80 md:w-96 lg:w-full max-w-lg" />
      </div>

      <!-- Illustration (only visible on mobile) -->
      <div data-aos="fade-up" data-aos-duration="1500"
        class="flex md:hidden items-center justify-center w-full mb-8">
        <img src="{{ asset('gambar/home/Analysis-pana.svg') }}" alt="" class="w-64" />
      </div>

      <!-- Right side - Content -->
      <div data-aos="fade-up" data-aos-duration="1500"
        class="flex w-full flex-col items-center md:items-start justify-center p-4 sm:p-8 md:w-1/2">
        <div class="mb-6 sm:mb-8">
          <h1 class="mb-4 sm:mb-6 text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 text-center md:text-left">
            <span class="text-orange-500">Internship</span> Program
          </h1>
          <p class="text-justify text-xs sm:text-sm md:text-base text-gray-600">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores consectetur nihil ea itaque quibusdam,
            magnam
            id corporis qui
            ducimus minus optio. Facilis et pariatur illo veniam odio quam consectetur possimus quis, praesentium, unde
            quo sed. Hic odio, a
            dignissimos, in facere obcaecati voluptates sunt explicabo aliquam aut ducimus sapiente officiis, natus ipsa
            commodi tempora?
            Vitae, animi. Quaerat, quam optio in omnis delectus laudantium est non consequatur earum? Illo, labore
            culpa.
          </p>
        </div>
        <div class="w-full flex justify-center md:justify-start">
          <a href="{{ route('program-magang.index', $info_magang->slug) }}">
            <button
              class="rounded-md border border-orange-500 px-3 py-1 sm:px-4 sm:py-2 text-xs sm:text-sm font-medium text-orange-500 transition-colors duration-300 hover:bg-orange-500 hover:text-white">
              Daftar Sekarang!
            </button>
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- Akhir Section Magang -->
  <x-footer class="fill-white" />
</x-layout-web>
