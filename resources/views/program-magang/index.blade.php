<x-layout-web>
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
  @if ($info->count() > 0)
    <section class="max-w-3xl py-10 mx-5 md:mx-auto">
      <h1 class="text-2xl md:text-4xl font-bold text-gray-900 mb-5">Posisi yang Dibutuhkan</h1>
      <!-- Grid Cards -->
      <div class="grid grid-cols-1 gap-10">
        @foreach ($info as $item)
          <!-- Card 1 -->
          <div class="bg-white rounded-xl shadow-lg border overflow-hidden border-gray-100">
            <div class="bg-primary p-4">
              <div class="flex items-center justify-between">
                <span class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 text-sm text-white font-medium">
                  {{ $item->nama_bidang }}
                </span>
                <div class="text-xs font-semibold text-gray-300">
                  {{ $item->created_at->diffForHumans() }}
                </div>
              </div>
              <h3 class="text-white text-xl font-bold mt-3">{{ $item->posisi }}</h3>
            </div>

            <div class="p-4">
              <div class="prose text-justify max-w-none text-sm font-semibold">
                {!! $item->deskripsi !!}
              </div>
            </div>

            <div class="p-4 flex items-center justify-center gap-5">
              <div class="flex items-center text-gray-600">
                <p class="text-sm font-semibold">Kebutuhan : <span
                    class="font-semibold text-gray-800">{{ $item->kebutuhan_orang }}
                    orang</span></p>
              </div>
              <div class="flex items-center text-gray-600">
                <p class="text-sm font-semibold">Pelamar : <span
                    class="font-semibold text-gray-800">{{ $item->pelamar }} orang</span></p>
              </div>
            </div>
            <div class="py-3 mx-4 flex border-t-2 border-gray-200 items-center justify-center">
              <a href="{{ route('program-magang.detail', ['slug_bidang' => $item->slug_bidang, 'slug_posisi' => $item->slug_posisi]) }}"
                class="text-primary font-semibold hover:underline">Lihat Selengkapnya!</a>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @else
    <section class="max-w-3xl py-10 mx-5 md:mx-auto">
      <h1 class="text-2xl md:text-4xl font-bold text-gray-900 mb-5">Posisi yang Dibutuhkan</h1>
      <div class="bg-white flex items-center justify-center rounded-xl min-h-[50vh] shadow-lg border border-gray-100">
        <h3 class="text-xl font-bold text-gray-600">Belum ada posisi yang dibutuhkan</h3>
      </div>
    </section>
  @endif
  <x-footer class="fill-[#EEF0F2]"></x-footer>
</x-layout-web>
