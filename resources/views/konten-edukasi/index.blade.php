<x-layout-web>
  <section class="bg-primary py-16 px-16 mb-10">
    <div class="flex flex-col items-center">
      <h1 class="mb-4 text-3xl font-bold text-white">
        {{ $subjek->judul }}
      </h1>
      <p class="mb-8 text-base text-justify md:text-center text-white">
        {{ $subjek->deskripsi }}
      </p>
    </div>
  </section>

  <section class="bg-[#EEF0F2] text-black flex justify-center items-stretch gap-5 px-5 mb-10">
    <div class="mx-auto max-w-lg lg:max-w-6xl px-4">
      @if ($artikels->count() > 0)
        <h1 class="mt-8 text-2xl font-bold text-center divider">Artikel</h1>
        <div class="splide mt-8 relative" aria-label="Splide Basic Example">
          <div class="splide__track mx-5 lg:mx-16 pb-10">
            <ul class="splide__list">
              @foreach ($artikels as $artikel)
                <li class="splide__slide px-14 lg:px-2">
                  <div
                    class="rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg flex flex-col h-full">
                    <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="" width=""
                      class="aspect-[3/2] rounded-lg object-cover" />
                    <h3 class="mt-4 mb-2 text-lg font-semibold">{{ $artikel->judul }}</h3>
                    <p class="mb-3 text-justify text-sm text-gray-500">
                      {{ Str::limit($artikel->deskripsi, 100, '...') }}
                    </p>
                    <a
                      href="{{ route('konten-edukasi.showArtikel', ['subjek_slug' => $artikel->subjek_materi->slug, 'slug' => $artikel->slug]) }}">
                      <button class="rounded-md bg-button px-4 py-2 text-sm font-medium text-white">Lihat
                        Selengkapnya</button>
                    </a>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      @if ($videos->count() > 0)
        <h1 class="mt-8 text-2xl font-bold text-center divider">Video Pembelajaran</h1>
        <div class="splide mt-8 relative" aria-label="Splide Basic Example">
          <div class="splide__track mx-5 lg:mx-16 pb-10">
            <ul class="splide__list">
              @foreach ($videos as $video)
                <li class="splide__slide px-14 lg:px-2">
                  <div
                    class="rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg flex flex-col h-full">
                    <img src="{{ $video->thumbnail }}" alt="" width=""
                      class="aspect-[3/2] rounded-lg object-cover" />
                    <h3 class="mt-4 mb-2 text-lg font-semibold">{{ $video->judul }}</h3>
                    <p class="mb-3 text-justify text-sm text-gray-500">
                      {{ Str::limit($video->deskripsi, 100, '...') }}
                    </p>
                    <a
                      href="{{ route('konten-edukasi.showVideo', ['subjek_slug' => $video->subjek_materi->slug, 'slug' => $video->slug]) }}">
                      <button class="rounded-md bg-button px-4 py-2 text-sm font-medium text-white">Lihat
                        Video</button>
                    </a>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      @if ($infografis->count() > 0)
        <h1 class="mt-8 text-2xl font-bold text-center divider">Infografis</h1>
        <div class="splide mt-8 relative" aria-label="Splide Basic Example">
          <div class="splide__track mx-4 sm:mx-16 pb-10">
            <ul class="splide__list">
              @foreach ($infografis as $item)
                <li class="splide__slide px-2">
                  <div
                    class="rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg flex flex-col h-full">
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="" width=""
                      class="aspect-[3/2] rounded-lg object-cover" />
                    <h3 class="mt-4 mb-2 text-lg font-semibold">{{ $item->judul }}</h3>
                    <p class="mb-3 text-justify text-sm text-gray-500">
                      {{ $item->deskripsi }}
                    </p>
                    <a href="{{ Storage::url($item->file_infografis) }}">
                      <button class="rounded-md bg-button px-4 py-2 text-sm font-medium text-white">Lihat
                        Infografis</button>
                    </a>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif
    </div>
  </section>
  <x-footer class="fill-[#EEF0F2]" />
</x-layout-web>
