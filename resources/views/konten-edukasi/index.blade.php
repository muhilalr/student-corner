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
        <div id="artikel-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
          @foreach ($artikels as $artikel)
            <div
              class="artikel-card hidden rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg flex-col justify-between h-full">
              <img src="{{ asset('storage/' . $artikel->gambar) }}" class="aspect-[3/2] rounded-lg object-cover" />
              <h3 class="mt-4 mb-2 text-lg font-semibold">{{ $artikel->judul }}</h3>
              <p class="mb-3 text-justify text-sm text-gray-500">{{ Str::limit($artikel->deskripsi, 100, '...') }}</p>
              <div class="flex items-center justify-between">
                <a
                  href="{{ route('konten-edukasi.showArtikel', ['subjek_slug' => $artikel->subjek_materi->slug, 'slug' => $artikel->slug]) }}">
                  <button class="rounded-md bg-button px-4 py-2 text-sm font-medium text-white">Lihat
                    Selengkapnya</button>
                </a>
                <span class="text-sm text-center text-gray-500">{{ $artikel->created_at->diffForHumans() }}</span>
              </div>
            </div>
          @endforeach
        </div>

        <div id="artikel-pagination" class="flex justify-center mt-6 space-x-2"></div>
      @endif

      @if ($videos->count() > 0)
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
      @endif

      @if ($infografis->count() > 0)
        <h1 class="mt-8 text-2xl font-bold text-center divider">Infografis</h1>
        <div id="infografis-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
          @foreach ($infografis as $item)
            <div
              class="infografis-card hidden rounded-lg bg-white p-4 sm:p-6 shadow-md transition-all duration-300 hover:shadow-lg flex-col justify-between h-full">
              <img src="{{ asset('storage/' . $item->gambar) }}" alt="" width=""
                class="aspect-[3/2] rounded-lg object-cover" />
              <h3 class="mt-4 mb-2 text-lg font-semibold">{{ $item->judul }}</h3>
              <p class="mb-3 text-justify text-sm text-gray-500">
                {{ $item->deskripsi }}
              </p>
              <div class="flex items-center justify-between">
                <a href="{{ Storage::url($item->file_infografis) }}">
                  <button class="rounded-md bg-button px-4 py-2 text-sm font-medium text-white">Lihat
                    Infografis</button>
                </a>
                <span class="text-sm text-center text-gray-500">{{ $item->created_at->diffForHumans() }}</span>
              </div>
            </div>
          @endforeach
        </div>

        <div id="infografis-pagination" class="flex justify-center mt-6 space-x-2"></div>
      @endif

      {{-- @if ($infografis->count() > 0)
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
      @endif --}}
    </div>
  </section>
  <x-footer class="fill-[#EEF0F2]" />
  <script>
    function setupPagination(sectionClass, itemsPerPage) {
      const items = document.querySelectorAll(`.${sectionClass}-card`);
      const pagination = document.getElementById(`${sectionClass}-pagination`);
      const totalPages = Math.ceil(items.length / itemsPerPage);

      function showPage(page) {
        items.forEach((item, index) => {
          item.style.display = (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) ?
            'flex' : 'none';
        });

        pagination.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
          const btn = document.createElement('button');
          btn.innerText = i;
          btn.className = 'px-3 py-1 rounded border bg-white text-black';
          if (i === page) btn.classList.add('bg-blue-800', 'text-white');
          btn.addEventListener('click', () => showPage(i));
          pagination.appendChild(btn);
        }
      }

      if (items.length > 0) showPage(1);
    }

    document.addEventListener('DOMContentLoaded', () => {
      // Deteksi ukuran layar
      const screenWidth = window.innerWidth;

      // Atur itemsPerPage responsif
      const itemsPerPage = screenWidth < 768 ? 3 : 6;

      setupPagination('artikel', itemsPerPage);
      setupPagination('video', itemsPerPage);
      setupPagination('infografis', itemsPerPage);
    });
  </script>

</x-layout-web>
