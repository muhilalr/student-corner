<x-layout-web>
  <!-- Hero Section -->
  <section class="bg-primary text-white min-h-[60vh] flex items-center">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <div class="text-center">

        <h1 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
          Kolaborasi Riset Mandiri
        </h1>

        <p class="text-lg md:text-xl text-blue-100 max-w-4xl mx-auto leading-relaxed font-semibold">
          Buka peluang kolaborasi penelitian bagi mahasiswa yang ingin mengembangkan skripsi atau karya ilmiah. Melalui
          program ini, kamu dapat bekerja sama untuk mendapatkan akses data dan bimbingan, serta menghasilkan riset yang
          bermanfaat secara akademik maupun praktis.
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
    <!-- Program Description -->
    <div class="bg-white rounded-3xl p-6 lg:p-10 shadow-xl mx-28 space-y-6">
      <div class="flex items-center gap-4 mb-6">
        <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center">
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
      <div class="flex items-center gap-4 mb-6">
        <div class="w-12 h-12 bg-button rounded-xl flex items-center justify-center">
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
      <div class="flex items-center gap-4 mb-6">
        <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center">
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
      <div class="flex items-center gap-4 mb-6">
        <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center">
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

    <div class="bg-primary mt-10 rounded-2xl p-8 text-white text-center flex flex-col gap-8 mx-28">
      <p class="text-blue-100 text-lg font-semibold max-w-2xl mx-auto">
        Jangan lewatkan kesempatan ini untuk mengembangkan penelitian Anda!
      </p>
      <a href="{{ route('daftar-riset.index') }}">
        <button
          class="bg-orange-500 w-full hover:bg-orange-600 text-white font-bold py-4 px-8 rounded-xl flex items-center justify-center max-w-xl mx-auto">
          Daftar Sekarang
        </button>
      </a>
      <div class="w-full max-w-xl mx-auto flex gap-4">
        @if ($sertifikat)
          <a href="{{ Storage::url($sertifikat) }}" class="flex-1" target="_blank">
            <button
              class="bg-button w-full hover:bg-[#02a66b] text-white font-bold py-4 px-8 rounded-xl flex items-center justify-center">
              Unduh Sertifikat Anda
            </button>
          </a>
        @endif
        <a href="{{ route('program-riset.arsipKarya') }}" class="flex-1">
          <button
            class="bg-button w-full hover:bg-[#02a66b] text-white font-bold py-4 px-8 rounded-xl flex items-center justify-center">
            Arsip Karya Kolaborasi Riset
          </button>
        </a>
      </div>
    </div>
  </section>

  <x-footer class="fill-[#EEF0F2]"></x-footer>
</x-layout-web>
