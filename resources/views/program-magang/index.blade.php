<x-layout-web>
  <!-- Hero Section -->
  <section class="bg-primary text-white min-h-[60vh] flex items-center">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <div class="text-center">

        <h1 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
          <span class="text-orange-500">Internship</span>
          <span class="text-white">Program</span>
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
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Main Card Container -->
      <div class="bg-white rounded-3xl shadow-xl border border-white">

        <!-- Card Content -->
        <div class="p-8 md:p-12">
          <div class="space-y-10">

            <!-- Deskripsi Program -->
            <div class="group">
              <div class="flex items-center mb-6">
                <div
                  class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">
                  Deskripsi Program</h3>
              </div>
              <div class="bg-blue-50/50 rounded-2xl p-6 border-l-4 border-blue-500">

                <div class="prose lg:prose-lg max-w-none text-base lg:text-lg text-justify font-semibold">
                  {!! $info->deskripsi !!}
                </div>

              </div>
            </div>

            <!-- Persyaratan -->
            <div class="group">
              <div class="flex items-center mb-6">
                <div
                  class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 group-hover:text-green-600 transition-colors duration-300">
                  Persyaratan</h3>
              </div>
              <div class="bg-green-50/50 rounded-2xl p-6 border-l-4 border-green-500">
                <div class="prose lg:prose-lg max-w-none text-base lg:text-lg text-justify font-semibold">
                  {!! $info->persyaratan !!}
                </div>
              </div>
            </div>

            <!-- Benefit -->
            <div class="group">
              <div class="flex items-center mb-6">
                <div
                  class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                  </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors duration-300">
                  Benefit</h3>
              </div>
              <div class="bg-purple-50/50 rounded-2xl p-6 border-l-4 border-purple-500">
                <div class="prose lg:prose-lg max-w-none text-base lg:text-lg text-justify font-semibold">
                  {!! $info->benefit !!}
                </div>
              </div>
            </div>

            <!-- Info Kontak -->
            <div class="group">
              <div class="flex items-center mb-6">
                <div
                  class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors duration-300">
                  Info Kontak</h3>
              </div>
              <div class="bg-orange-50/50 rounded-2xl p-6 border-l-4 border-orange-500">
                <div class="prose lg:prose-lg max-w-none text-base lg:text-lg text-justify font-semibold">
                  {!! $info->info_kontak !!}
                </div>
              </div>
            </div>

          </div>

          <!-- CTA Section -->
          <div class="mt-12 pt-8 border-t border-gray-200">
            <div class="bg-primary rounded-2xl p-8 text-white text-center flex flex-col">
              <p class="text-blue-100 mb-8 text-lg font-semibold max-w-2xl mx-auto">
                Jangan lewatkan kesempatan ini untuk mengembangkan karir dan memperluas jaringan profesional Anda!
              </p>
              <a href="{{ route('daftar-magang.index') }}">
                <button
                  class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-8 rounded-xl flex items-center max-w-sm mx-auto">
                  Daftar Sekarang
                </button>
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
    </div>
  </section>

  <x-footer class="fill-[#EEF0F2]"></x-footer>
</x-layout-web>
