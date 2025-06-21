<x-layout-web>
  <!-- Hero Section -->
  <section class="bg-primary text-white py-20">
    <div class="container mx-auto text-center px-4">
      <h1 class="text-5xl font-bold mb-4">Kuis & Tantangan Statistik</h1>
      <p class="text-xl text-blue-100">Uji pengetahuan statistik Anda dan raih peringkat tertinggi!</p>
    </div>
  </section>

  <!-- Kuis Reguler Section -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Kuis Reguler</h2>
        <p class="text-xl text-gray-600 font-semibold">Asah kemampuan statistik Anda dengan berbagai topik menarik</p>
      </div>
      <div class="splide mt-8 relative" aria-label="Splide Basic Example">
        <div class="splide__track mx-4 sm:mx-16 pb-10">
          <ul class="splide__list">
            @foreach ($kuis as $item)
              <li class="splide__slide px-2">
                <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-md flex flex-col justify-between h-full">
                  <img src="{{ asset('storage/' . $item->gambar) }}" alt="" width="500"
                    class="aspect-[3/2] rounded-lg object-cover" />
                  <h3 class="text-xl font-bold text-gray-800 my-2">{{ $item->judul }}</h3>
                  <p class="text-gray-600 font-semibold mb-4">
                    {{ Str::limit($item->deskripsi, 150, '...') }}</p>
                  <a href="{{ route('kuis-tantangan.soal', $item->slug) }}">
                    <button class="bg-primary w-full text-white px-4 py-2 rounded-lg hover:bg-[#00295A]">
                      Mulai
                    </button>
                  </a>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Tantangan Bulanan Section -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Tantangan Bulanan</h2>
        <p class="text-xl text-gray-600 font-semibold">Kompetisi bulanan dengan hadiah menarik menanti Anda!</p>
      </div>

      <!-- Current Challenge -->
      <div class="bg-primary rounded-3xl p-8 mb-8 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white bg-opacity-10 rounded-full -ml-12 -mb-12"></div>
        <div class="relative z-10">
          @if ($tantangan)
            <div class="flex flex-col items-center justify-center mb-6">
              <h3 class="text-3xl font-bold mb-2">{{ $tantangan->judul }}</h3>
              <p class="text-lg opacity-90">{{ $tantangan->deskripsi }}</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
              <div class="bg-white bg-opacity-20 rounded-lg p-4">
                <div class="flex items-center">
                  <i class="fas fa-calendar-alt text-2xl mr-3"></i>
                  <div>
                    <p class="text-sm opacity-80">Berakhir dalam</p>
                    <p class="text-xl font-bold">
                      {{ round($hariTersisa) }}
                      Hari</p>
                  </div>
                </div>
              </div>
              <div class="bg-white bg-opacity-20 rounded-lg p-4">
                <div class="flex items-center">
                  <i class="fas fa-users text-2xl mr-3"></i>
                  <div>
                    <p class="text-sm opacity-80">Partisipan</p>
                    <p class="text-xl font-bold">{{ $jumlahUser }} Orang</p>
                  </div>
                </div>
              </div>
              <div class="bg-white bg-opacity-20 rounded-lg p-4">
                <div class="flex items-center">
                  <i class="fas fa-gift text-2xl mr-3"></i>
                  <div>
                    <p class="text-sm opacity-80">Soal</p>
                    <p class="text-xl font-bold">{{ $tantangan->soal_tantangan_bulanan->count() }} Soal</p>
                  </div>
                </div>
              </div>
            </div>
            <a href="{{ route('tantangan-bulanan.soal', $tantangan->slug) }}">
              <button
                class="bg-button w-full text-white px-8 py-3 rounded-full font-bold hover:bg-[#02a66b] transition duration-300 shadow-lg">
                Mulai Kuis Sekarang
              </button>
            </a>
          @else
            <div class="my-16">
              <div class="bg-white bg-opacity-20 rounded-lg p-4">
                <div class="flex flex-col justify-center items-center">
                  <h3 class="text-3xl font-bold mb-2">Tantangan Bulanan Belum Tersedia Saat Ini</h3>
                  <p class="text-lg font-semibold opacity-90">Silahkan kembali lagi nanti</p>
                </div>
              </div>
            </div>
          @endif

        </div>
      </div>
    </div>
  </section>

  <!-- Leaderboard Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Leaderboard Tantangan Bulanan</h2>
        <p class="text-xl font-semibold text-gray-600">Partisipan teratas tantangan bulanan</p>
      </div>

      <div class="max-w-4xl mx-auto">
        <!-- Top 3 -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          @foreach ($topUsers->take(3) as $index => $user)
            @php
              $ranking = $index + 1;

              $bgColor = match ($ranking) {
                  1 => 'bg-gradient-to-br from-yellow-400 to-yellow-600 text-white',
                  2 => 'bg-gradient-to-br from-gray-400 to-gray-600 text-white',
                  3 => 'bg-gradient-to-br from-amber-600 to-amber-700 text-white',
                  default => 'bg-white text-gray-800',
              };

              $iconBg = match ($ranking) {
                  1 => 'bg-yellow-300 text-yellow-800',
                  2 => 'bg-gray-400 text-white',
                  3 => 'bg-amber-500 text-white',
                  default => 'bg-gray-300 text-white',
              };

              $scoreColor = match ($ranking) {
                  1 => 'text-white',
                  2 => 'text-white',
                  3 => 'text-white',
                  default => 'text-gray-800',
              };

              // Urutan layout visual: 2 kiri, 1 tengah, 3 kanan
              $orderClass = match ($ranking) {
                  1 => 'order-2 md:order-2 -translate-y-8', // naik sedikit
                  2 => 'order-1 md:order-1',
                  3 => 'order-3 md:order-3',
                  default => '',
              };
            @endphp

            <div
              class="{{ $bgColor }} {{ $orderClass }} rounded-2xl p-6 text-center card-hover transform transition-all duration-300">
              <div class="relative inline-block mb-4">
                @if ($user->user->foto == null)
                  <img src="{{ Avatar::create($user->user->name)->toBase64() }}" alt="User"
                    class="w-{{ $ranking == 1 ? '24' : '20' }} h-{{ $ranking == 1 ? '24' : '20' }} rounded-full mx-auto object-cover">
                @else
                  <img src="{{ asset('storage/' . $user->user->foto) }}" alt="User"
                    class="w-{{ $ranking == 1 ? '24' : '20' }} h-{{ $ranking == 1 ? '24' : '20' }} rounded-full mx-auto object-cover">
                @endif
                <div
                  class="absolute -top-2 -right-2 {{ $iconBg }} w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                  {{ $ranking }}
                </div>
              </div>
              <h3 class="text-xl font-bold mb-1">{{ $user->user->name }}</h3>
              <p class="text-2xl font-bold {{ $scoreColor }}">{{ $user->total_skor }} poin</p>

              @if ($ranking == 1)
                <div class="mt-4">
                  <i class="fas fa-trophy text-2xl pulse-animation"></i>
                </div>
              @endif
            </div>
          @endforeach
        </div>




        <!-- Remaining Rankings -->
        <div class="bg-white rounded-2xl shadow-lg">
          <div class="p-6 border-b flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-800">Peringkat Lengkap</h3>
            <h3 class="text-xl font-bold text-gray-800">Skor</h3>
          </div>
          <div class="divide-y">
            @foreach ($topUsers->skip(3) as $index => $user)
              <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition duration-300">
                <div class="flex items-center">
                  <span
                    class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-sm font-bold text-gray-600 mr-4">
                    {{ $index + 1 }}
                  </span>
                  @if ($user->user->foto == null)
                    <img src="{{ Avatar::create($user->user->name)->toBase64() }}" alt="User"
                      class="w-10 h-10 rounded-full mr-3 object-cover">
                  @else
                    <img src="{{ asset('storage/' . $user->user->foto) }}" alt="User"
                      class="w-10 h-10 rounded-full mr-3 object-cover">
                  @endif
                  <div>
                    <p class="font-bold text-gray-800">{{ $user->user->name }}</p>
                  </div>
                </div>
                <span class="text-lg font-bold text-gray-800">{{ $user->total_skor }} poin</span>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  <x-footer class="fill-gray-50"></x-footer>
</x-layout-web>
