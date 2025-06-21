<x-layout-web>
  <section class="w-full flex px-4 md:px-8 lg:px-10 py-16 bg-[#EEF0F2] min-h-screen">
    <div class="max-w-7xl mx-auto w-full">
      <!-- Header -->
      <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Profil Saya</h1>
        <p class="text-gray-600">Lihat dan kelola informasi akun Anda</p>
      </div>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <x-user.sidebar />

        <!-- Main Profile Content -->
        <div class="lg:col-span-3">
          <!-- Main Profile Card -->
          <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Profile Header Section -->
            <div class="relative bg-primary px-8 py-12">
              <div class="absolute inset-0 bg-black opacity-10"></div>
              <div class="relative flex flex-col md:flex-row items-center gap-6">
                <!-- Profile Photo -->
                <div class="relative group">
                  <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg overflow-hidden bg-white">
                    @if ($user->foto)
                      <img src="{{ asset('storage/' . $user->foto) }}" class="w-full h-full object-cover"
                        alt="Profile Photo">
                    @else
                      <img src="{{ Avatar::create($user->name)->toBase64() }}" class="w-full h-full object-cover"
                        alt="Generated Avatar">
                    @endif
                  </div>
                </div>

                <!-- Profile Info -->
                <div class="text-center md:text-left text-white">
                  <h2 class="text-2xl md:text-3xl font-bold mb-2">{{ $user->name }}</h2>
                  <p class="text-blue-100 mb-4">{{ $user->email }}</p>
                </div>
              </div>
            </div>

            <!-- Profile Details -->
            <div class="p-8">
              @if (session('success'))
                <div class="bg-button border border-button text-white px-4 py-3 rounded relative mb-8" role="alert">
                  <span class="block sm:inline">{{ session('success') }}</span>
                </div>
              @endif

              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Personal Information -->
                <div class="space-y-6">
                  <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                      <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                      </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Personal</h3>
                  </div>

                  <!-- Name -->
                  <div class="group">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700 mb-2">
                      <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                      </svg>
                      Nama Lengkap
                    </label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                      <p class="text-gray-900 font-medium">{{ $user->name }}</p>
                    </div>
                  </div>

                  <!-- Email -->
                  <div class="group">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700 mb-2">
                      <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                      </svg>
                      Email Address
                    </label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                      <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                    </div>
                  </div>

                  <!-- Gender -->
                  <div class="group">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700 mb-2">
                      <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                        </path>
                      </svg>
                      Jenis Kelamin
                    </label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                      <p class="text-gray-900 font-medium">{{ $user->jenis_kelamin }}</p>
                    </div>
                  </div>
                </div>

                <!-- Contact & Organization -->
                <div class="space-y-6">
                  <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                      <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                      </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Kontak & Organisasi</h3>
                  </div>

                  <!-- WhatsApp -->
                  <div class="group">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700 mb-2">
                      <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                      </svg>
                      Nomor WhatsApp
                    </label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                      <p class="text-gray-900 font-medium">{{ $user->no_hp }}</p>
                    </div>
                  </div>

                  <!-- Organization -->
                  <div class="group">
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700 mb-2">
                      <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                      </svg>
                      Instansi
                    </label>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-3">
                      <p class="text-gray-900 font-medium">{{ $user->instansi }}</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-8 border-t border-gray-200">
                <a href="{{ route('profil.edit', $user->slug) }}"
                  class="flex-1 bg-primary hover:bg-[#00295A] text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                  </svg>
                  Edit Profil
                </a>
                <button type="button" data-url="{{ route('profil.destroy', $user->id) }}"
                  onclick="openDeleteModal(this)"
                  class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                  </svg>
                  Hapus Akun
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <x-footer class="fill-[#EEF0F2]" />

  <!-- Modal Konfirmasi Hapus Akun -->
  <div id="deleteConfirmationModal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-75">
    <div class="bg-white rounded-xl p-6 shadow-2xl w-full max-w-md mx-4 transform transition-all">
      <!-- Header Modal -->
      <div class="flex items-center gap-3 mb-4">
        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
          <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
            </path>
          </svg>
        </div>
        <div>
          <h2 class="text-xl font-bold text-gray-900">Konfirmasi Hapus Akun</h2>
        </div>
      </div>

      <!-- Konten Modal -->
      <div class="mb-6">
        <p class="text-gray-700 leading-relaxed">
          Apakah Anda yakin ingin menghapus akun <strong>{{ $user->name }}</strong>?
          Semua data dan informasi yang terkait dengan akun ini akan dihapus secara permanen.
        </p>
        <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
          <p class="text-sm text-red-800 font-medium">
            ⚠️ Peringatan: Tindakan ini tidak dapat dibatalkan!
          </p>
        </div>
      </div>

      <!-- Tombol Aksi -->
      <div class="flex flex-col sm:flex-row gap-3">
        <button id="cancelButton" type="button"
          class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium rounded-lg transition-colors duration-200">
          Batal
        </button>
        <form id="deleteForm" method="POST" action="{{ route('profil.destroy', $user->id) }}" class="flex-1">
          @csrf
          @method('DELETE')
          <button type="submit"
            class="w-full px-4 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
              </path>
            </svg>
            Ya, Hapus Akun
          </button>
        </form>
      </div>
    </div>
  </div>

  <script>
    function openDeleteModal(button) {
      const modal = document.getElementById('deleteConfirmationModal');
      const deleteForm = document.getElementById('deleteForm');

      // Ambil URL dari data-url tombol
      const deleteUrl = button.getAttribute('data-url');
      deleteForm.setAttribute('action', deleteUrl);

      // Tampilkan modal dengan animasi
      modal.classList.remove('hidden');

      // Tambahkan event listener untuk menutup modal dengan ESC
      document.addEventListener('keydown', handleEscapeKey);
    }

    function closeDeleteModal() {
      const modal = document.getElementById('deleteConfirmationModal');
      modal.classList.add('hidden');

      // Hapus event listener ESC
      document.removeEventListener('keydown', handleEscapeKey);
    }

    function handleEscapeKey(event) {
      if (event.key === 'Escape') {
        closeDeleteModal();
      }
    }

    // Event listener untuk tombol batal
    document.getElementById('cancelButton').addEventListener('click', closeDeleteModal);

    // Event listener untuk menutup modal ketika klik di luar modal
    document.getElementById('deleteConfirmationModal').addEventListener('click', function(event) {
      if (event.target === this) {
        closeDeleteModal();
      }
    });

    // Mencegah modal tertutup ketika klik di dalam konten modal
    document.querySelector('#deleteConfirmationModal > div').addEventListener('click', function(event) {
      event.stopPropagation();
    });
  </script>

</x-layout-web>
