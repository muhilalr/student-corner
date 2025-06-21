<!-- Navigation Bar -->
<nav class="sticky top-0 z-50 bg-white px-4 sm:px-6 py-4 border-b ">
  <div class="container mx-auto flex items-center justify-between">
    <!-- Logo -->

    <div class="mr-1 text-xl font-bold text-orange-500">Pojok Literasi Statistik</div>


    <!-- Mobile Menu Button (Hamburger) -->
    <div class="md:hidden">
      <button onclick="toggleMenu()" class="text-gray-500 hover:text-orange-500 focus:outline-none">
        <svg id="hamburger-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Desktop Navigation Links -->
    <div class="hidden space-x-4 lg:space-x-5 md:flex">
      <a href="{{ route('home') }}"
        class="bg-white hover:bg-gray-100 flex px-4 py-2 text-base text-slate-700 font-medium rounded-md">Home</a>
      <div class="dropdown dropdown-hover">
        <div tabindex="0" role="button"
          class="bg-white hover:bg-gray-100 flex gap-1 pl-4 pr-2 py-2 text-base text-slate-700 font-medium rounded-md">
          Konten
          Edukasi
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
            <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
          </svg>
        </div>
        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-md">
          <li class="text-sm text-slate-700 font-medium mb-2 pl-3 border-b border-gray-400 py-2">Pilih Topik</li>
          @foreach ($subjek_materi as $item)
            <li><a href="{{ route('konten-edukasi.show', $item->slug) }}">{{ $item->judul }}</a></li>
          @endforeach
        </ul>
      </div>
      <div class="dropdown dropdown-hover">
        <div tabindex="0" role="button"
          class="bg-white hover:bg-gray-100 flex gap-1 pl-4 pr-2 py-2 text-base text-slate-700 font-medium rounded-md">
          Alat
          Interaktif
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
            <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
          </svg>
        </div>
        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-md">
          <li><a href="{{ route('kalkulator-statistik.index') }}">Kalkulator Statistik</a></li>
          <li><a href="{{ route('visualisasi.index') }}">Visualisasi Data</a></li>
          <li><a>Simulasi Statistik</a></li>
        </ul>
      </div>
      <a href="{{ route('kuis-tantangan.index') }}"
        class="bg-white hover:bg-gray-100 flex px-4 py-2 text-base text-slate-700 font-medium rounded-md">Kuis &
        Tantangan</a>
      <a href="{{ route('program-magang.index') }}"
        class="bg-white hover:bg-gray-100 flex px-4 py-2 text-base text-slate-700 font-medium rounded-md">Internship</a>
    </div>

    <!-- Sign Up Button (Desktop) -->
    @if (Auth::check())
      @if (Auth::user()->foto)
        {{-- Jika user punya foto upload --}}
        <div class="dropdown dropdown-end">
          <div tabindex="0" role="button"
            class="flex items-center gap-2 border border-gray-400 rounded-md px-2 py-1">
            <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="w-7 h-7 rounded-full">
            <p class="text-sm text-slate-700 font-medium">
              {{ collect(explode(' ', Auth::user()->name))->take(2)->implode(' ') }}</p>
          </div>
          <ul tabindex="0"
            class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm border border-gray-200">
            <li><a href="{{ route('profil.show', Auth::user()->slug) }}">Profil</a></li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <li>
                <button type="submit">Logout</button>
              </li>
            </form>
          </ul>
        </div>
      @else
        {{-- Gunakan laravolt avatar jika tidak ada foto --}}
        <div class="dropdown dropdown-end">
          <div tabindex="0" role="button"
            class="flex items-center gap-2 border border-gray-400 rounded-md px-2 py-1">
            <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" class="w-7 h-7 rounded-full">
            <p class="text-sm text-slate-700 font-medium">
              {{ collect(explode(' ', Auth::user()->name))->take(2)->implode(' ') }}</p>
          </div>
          <ul tabindex="0"
            class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm border border-gray-200">
            <li><a href="{{ route('profil.show', Auth::user()->slug) }}">Profil</a></li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <li>
                <button type="submit">Logout</button>
              </li>
            </form>
          </ul>
        </div>
      @endif
    @else
      <div class="hidden md:block">
        <a href="{{ route('login') }}">
          <button class="rounded-md bg-button hover:bg-[#02a66b] px-4 py-2 font-medium text-white">Login</button>
        </a>
      </div>
    @endif
  </div>

  <!-- Mobile Menu (Slide Down) -->
  <div id="mobile-menu" class="md:hidden hidden">
    <div class="mt-4 space-y-1 border-t px-2 pt-2 pb-3">
      <a href="#"
        class="block rounded-md px-4 py-2 text-gray-700 hover:bg-orange-100 hover:text-orange-500">Home</a>
      <a href="#"
        class="block rounded-md px-4 py-2 text-gray-700 hover:bg-orange-100 hover:text-orange-500">Konten Edukasi</a>
      <a href="#" class="block rounded-md px-4 py-2 text-gray-700 hover:bg-orange-100 hover:text-orange-500">Alat
        Interaktif</a>
      <a href="#" class="block rounded-md px-4 py-2 text-gray-700 hover:bg-orange-100 hover:text-orange-500">Kuis
        dan
        Tantangan</a>
      <a href="#"
        class="block rounded-md px-4 py-2 text-gray-700 hover:bg-orange-100 hover:text-orange-500">Internship</a>
      <div class="px-4 py-2">
        <a href="{{ route('login') }}">
          <button class="w-full rounded-md bg-button px-4 py-2 font-medium text-white">Login</button>
        </a>
      </div>
    </div>
  </div>
</nav>
<!-- End of Navigation Bar -->
