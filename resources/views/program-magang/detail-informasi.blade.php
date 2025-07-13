<x-layout-web>
  <!-- Hero Section -->
  <section class="bg-primary text-white min-h-[60vh] flex items-center">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <div class="text-center">

        <h1 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
          Magang dan Riset
        </h1>

        <p class="text-lg md:text-xl text-blue-100 max-w-4xl mx-auto leading-relaxed font-semibold">
          Dapatkan pengalaman kerja nyata dan kembangkan keterampilan profesionalmu melalui program magang kami.
          Belajar langsung dari para ahli, berkontribusi pada proyek-proyek inovatif, dan persiapkan dirimu untuk
          karier yang cemerlang.
        </p>

        <!-- Scroll Indicator -->
        <div class="mt-12 animate-bounce">
          <svg class="w-6 h-6 mx-auto text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
          </svg>
        </div>
      </div>
    </div>
  </section>

  <!-- Main Content Section -->
  <section class="py-20 bg-[#EEF0F2] min-h-screen">
    <div class="max-w-6xl mx-auto px-6 lg:px-8">
      <!-- Main Content Grid -->
      <div class="grid lg:grid-cols-2 gap-8 mb-8">

        <!-- Left Column - Position Info -->
        <div class="space-y-8">
          <div class="bg-white rounded-3xl p-8 shadow-xl">
            <div class="flex items-center gap-4 mb-6">
              <div
                class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center icon-glow">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                  </path>
                </svg>
              </div>
              <div>
                <span
                  class="inline-block bg-emerald-100 text-emerald-800 text-sm font-semibold px-4 py-2 rounded-full mb-2">
                  {{ $info->nama_bidang }}
                </span>
                <h2 class="text-3xl font-bold text-gray-900">{{ $info->posisi }}</h2>
              </div>
            </div>
          </div>

          <!-- Program Description -->
          <div class="bg-white rounded-3xl p-8 shadow-xl">
            <div class="flex items-center gap-4 mb-6">
              <div
                class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-900">Deskripsi Program</h3>
            </div>
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-6 border-l-4 border-blue-500">
              <div class="prose lg:prose-lg max-w-none text-base lg:text-lg text-justify font-semibold">
                {!! $info->deskripsi !!}
              </div>
            </div>
          </div>

          <!-- Contact Information -->
          <div class="bg-white max-w-xl mx-auto rounded-3xl p-8 shadow-xl mb-16">
            <div class="flex items-center gap-4 mb-6">
              <div
                class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-900">Info Kontak</h3>
            </div>
            <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-2xl p-6 border-l-4 border-orange-500">
              <div class="prose lg:prose-lg max-w-none text-base lg:text-lg text-justify font-semibold">
                {!! $info->info_kontak !!}
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column - Requirements & Benefits -->
        <div class="space-y-8">
          <!-- Requirements -->
          <div class="bg-white rounded-3xl p-8 shadow-xl">
            <div class="flex items-center gap-4 mb-6">
              <div
                class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-900">Persyaratan</h3>
            </div>
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border-l-4 border-green-500">
              <div class="prose lg:prose-lg max-w-none text-base lg:text-lg text-justify font-semibold">
                {!! $info->persyaratan !!}
              </div>
            </div>
          </div>

          <!-- Benefits -->
          <div class="bg-white rounded-3xl p-8 shadow-xl">
            <div class="flex items-center gap-4 mb-6">
              <div
                class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-900">Benefit</h3>
            </div>
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border-l-4 border-purple-500">
              <div class="prose lg:prose-lg max-w-none text-base lg:text-lg text-justify font-semibold">
                {!! $info->benefit !!}
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-primary mt-10 rounded-2xl p-8 text-white text-center flex flex-col">
        <p class="text-blue-100 mb-8 text-lg font-semibold max-w-2xl mx-auto">
          Jangan lewatkan kesempatan ini untuk mengembangkan karir dan memperluas jaringan profesional Anda!
        </p>
        <a
          href="{{ route('daftar-magang.index', ['slug_bidang' => $info->slug_bidang, 'slug_posisi' => $info->slug_posisi]) }}">
          <button
            class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-8 rounded-xl flex items-center max-w-sm mx-auto">
            Daftar Sekarang
          </button>
        </a>
      </div>
    </div>
    </div>
  </section>

  <x-footer class="fill-[#EEF0F2]"></x-footer>
</x-layout-web>
