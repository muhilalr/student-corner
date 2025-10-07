<x-layout-web>
  <section class="bg-primary py-16 px-16 mb-10">
    <div class="flex flex-col items-center">
      <h1 class="mb-4 text-3xl font-bold text-white">
        {{ $subjek->judul }}
      </h1>
      <p class="mb-8 text-base text-center text-white">
        {{ $subjek->deskripsi }}
      </p>
    </div>
  </section>

  <section class="bg-[#EEF0F2] text-black flex justify-center items-stretch gap-5 px-5 mb-10">
    <div class="mx-auto max-w-lg lg:max-w-6xl px-4">

      <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1">
          <div class="bg-white rounded-2xl shadow-xl">
            <div class="p-6">
              <h3 class="text-lg font-bold text-center text-gray-900 mb-2">Filter Konten</h3>
              <nav class="space-y-2">
                <form method="GET" action="{{ route('konten-edukasi.show', ['slug' => $subjek->slug]) }}"
                  class="flex flex-col">
                  {{-- Filter Tipe --}}

                  <fieldset class="fieldset">
                    <legend class="fieldset-legend text-base">Jenis Konten</legend>
                    <select name="tipe" class="select focus:border-none w-full">
                      <option value="">Semua Tipe</option>
                      <option value="artikel" {{ request('tipe') == 'artikel' ? 'selected' : '' }}>Artikel</option>
                      <option value="video" {{ request('tipe') == 'video' ? 'selected' : '' }}>Video</option>
                      <option value="infografis" {{ request('tipe') == 'infografis' ? 'selected' : '' }}>Infografis
                      </option>
                    </select>
                  </fieldset>

                  <fieldset class="fieldset">
                    <legend class="fieldset-legend text-base">Tahun</legend>
                    <select name="tahun" class="select focus:border-none w-full">
                      <option value="">Semua Tahun</option>
                      @foreach (range(date('Y'), 2025) as $tahun)
                        {{-- misalnya dari 2020 --}}
                        <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                          {{ $tahun }}
                        </option>
                      @endforeach
                    </select>
                  </fieldset>

                  <button type="submit" class="mt-4 px-4 py-2 bg-primary hover:bg-[#00295A] text-white rounded-lg">
                    Filter
                  </button>
                </form>


              </nav>
            </div>
          </div>
        </div>


        <div class="lg:col-span-3">
          <div id="artikel-container" class="flex flex-col gap-5">
            @forelse ($kontens as $konten)
              <a
                href="@if ($konten->tipe === 'artikel') {{ route('konten-edukasi.showArtikel', [$subjek->slug, $konten->slug]) }}
  @elseif ($konten->tipe === 'video')
    {{ route('konten-edukasi.showVideo', [$subjek->slug, $konten->slug]) }}
  @elseif ($konten->tipe === 'infografis')
    {{ route('infografis.lihat', $konten->id) }} @endif">
                <div class="rounded-lg bg-white p-4 shadow-md hover:cursor-pointer flex gap-4">
                  {{-- Thumbnail --}}
                  <img src="{{ $konten->thumbnail }}" class="aspect-[16/9] rounded-lg w-32 object-cover">

                  <div>
                    {{-- Label tipe --}}
                    <h3 class="text-sm font-semibold text-black">{{ Str::ucfirst($konten->tipe) }}</h3>

                    {{-- Judul & Deskripsi --}}
                    <h2 class="text-lg font-bold text-primary">{{ $konten->judul }}</h2>
                    <p class="text-gray-500 text-sm text-justify">{{ $konten->deskripsi }}</p>

                    {{-- Tanggal --}}
                    <span class="mt-2 text-xs text-gray-400">
                      {{ \Carbon\Carbon::parse($konten->created_at)->diffForHumans() }}
                    </span>
                  </div>
                </div>
              </a>
            @empty
              <p class="col-span-3 text-center text-gray-500">Belum ada konten.</p>
            @endforelse

            {{ $kontens->links('vendor.pagination.custom') }}
          </div>

          {{-- @if ($videos->count() > 0)
            <h1 class="mt-8 text-2xl font-bold text-center divider">Video</h1>
            <div id="video-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
              @foreach ($videos as $video)
                <div
                  class="video-card hidden rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg flex-col justify-between h-full">
                  <img src="{{ $video->thumbnail }}" alt="" width=""
                    class="aspect-[3/2] rounded-lg object-cover" />
                  <h3 class="mt-4 mb-2 text-lg font-semibold">{{ $video->judul }}</h3>
                  <p class="mb-3 text-justify text-sm text-gray-500">
                    {{ Str::limit($video->deskripsi, 100, '...') }}
                  </p>
                  <div class="flex items-center justify-between">
                    <a
                      href="{{ route('konten-edukasi.showVideo', ['subjek_slug' => $video->subjek_materi->slug, 'slug' => $video->slug]) }}">
                      <button class="rounded-md bg-button px-4 py-2 text-sm font-medium text-white">Lihat
                        Video</button>
                    </a>
                    <span class="text-sm text-center text-gray-500">{{ $video->created_at->diffForHumans() }}</span>
                  </div>
                </div>
              @endforeach
            </div>

            <div id="video-pagination" class="flex justify-center mt-6 space-x-2"></div>
          @endif --}}
        </div>


      </div>
    </div>
  </section>
  <x-footer class="fill-[#EEF0F2]" />
</x-layout-web>
