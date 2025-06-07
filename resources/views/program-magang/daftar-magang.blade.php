<x-layout-web>
  <!-- Hero Section -->
  <section class="bg-primary text-white min-h-[50vh] flex items-center mb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="text-center">
        <h1 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
          <span class="text-white">Daftar</span>
          <br>
          <span class="text-orange-500">Internship Program</span>
        </h1>

        <p class="text-lg md:text-xl text-indigo-100 max-w-3xl mx-auto leading-relaxed font-semibold">
          @if (isset($pendaftaran) && $pendaftaran)
            Status pendaftaran: {{ ucfirst($pendaftaran->status) }}
          @else
            Lengkapi formulir di bawah ini untuk memulai perjalanan karir profesional Anda
          @endif
        </p>
      </div>
    </div>
  </section>

  <!-- Form Section atau Success Message -->
  <section class="bg-[#EEF0F2] mb-10 px-3">
    <!-- Main Container -->
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 bg-white rounded-3xl shadow-md">

      @if (isset($pendaftaran) && $pendaftaran)
        <!-- Success/Status Message -->
        <div class="text-center py-16">
          <!-- Status Icon -->
          <div
            class="w-24 h-24 {{ $pendaftaran->status === 'diterima' ? 'bg-green-100' : ($pendaftaran->status === 'ditolak' ? 'bg-red-100' : 'bg-blue-100') }} rounded-full flex items-center justify-center mx-auto mb-8">
            @if ($pendaftaran->status === 'diterima')
              <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            @elseif($pendaftaran->status === 'ditolak')
              <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            @else
              <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            @endif
          </div>

          <!-- Status Title -->
          <h2 class="text-3xl font-bold text-gray-900 mb-4">
            @switch($pendaftaran->status)
              @case('pending')
                Pendaftaran Berhasil Diterima!
              @break

              @case('diproses')
                Pendaftaran Sedang Diproses
              @break

              @case('diterima')
                Selamat! Pendaftaran Diterima
              @break

              @case('ditolak')
                Pendaftaran Tidak Dapat Diterima
              @break

              @default
                Status Pendaftaran
            @endswitch
          </h2>

          <!-- Status Message -->
          <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
            @switch($pendaftaran->status)
              @case('pending')
                Terima kasih telah mendaftar untuk program magang kami. Aplikasi Anda telah berhasil diterima dan akan
                segera diproses oleh tim kami.
              @break

              @case('diproses')
                Aplikasi Anda sedang dalam tahap review oleh tim HR kami. Mohon menunggu informasi lebih lanjut.
              @break

              @case('diterima')
                Selamat! Pendaftaran magang Anda telah diterima. Tim kami akan segera menghubungi Anda untuk langkah
                selanjutnya.
              @break

              @case('ditolak')
                Mohon maaf, saat ini kami tidak dapat menerima aplikasi magang Anda. Terima kasih atas minat Anda terhadap
                perusahaan kami.
              @break

              @default
                Status pendaftaran Anda saat ini: {{ ucfirst($pendaftaran->status) }}
            @endswitch
          </p>

          <!-- Status Timeline -->
          <div class="max-w-2xl mx-auto mb-8">
            <div class="flex items-center justify-between">
              <div class="flex flex-col items-center">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mb-2">
                  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                </div>
                <span class="text-sm font-medium text-green-600">Diterima</span>
              </div>

              <div
                class="flex-1 h-1 mx-4 {{ in_array($pendaftaran->status, ['diproses', 'diterima', 'ditolak']) ? 'bg-green-200' : 'bg-gray-200' }}">
              </div>

              <div class="flex flex-col items-center">
                <div
                  class="w-10 h-10 {{ in_array($pendaftaran->status, ['diproses', 'diterima', 'ditolak']) ? 'bg-blue-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center mb-2">
                  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                  </svg>
                </div>
                <span
                  class="text-sm font-medium {{ in_array($pendaftaran->status, ['diproses', 'diterima', 'ditolak']) ? 'text-blue-600' : 'text-gray-500' }}">Review</span>
              </div>

              <div
                class="flex-1 h-1 mx-4 {{ $pendaftaran->status === 'diterima' ? 'bg-green-200' : ($pendaftaran->status === 'ditolak' ? 'bg-red-200' : 'bg-gray-200') }}">
              </div>

              <div class="flex flex-col items-center">
                <div
                  class="w-10 h-10 {{ $pendaftaran->status === 'diterima' ? 'bg-green-500' : ($pendaftaran->status === 'ditolak' ? 'bg-red-500' : 'bg-gray-300') }} rounded-full flex items-center justify-center mb-2">
                  @if ($pendaftaran->status === 'diterima')
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                  @elseif($pendaftaran->status === 'ditolak')
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  @else
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                  @endif
                </div>
                <span
                  class="text-sm font-medium {{ $pendaftaran->status === 'diterima' ? 'text-green-600' : ($pendaftaran->status === 'ditolak' ? 'text-red-600' : 'text-gray-500') }}">
                  {{ $pendaftaran->status === 'diterima' ? 'Diterima' : ($pendaftaran->status === 'ditolak' ? 'Ditolak' : 'Hasil') }}
                </span>
              </div>
            </div>
          </div>

          <!-- Info Cards -->
          @if ($pendaftaran->status !== 'ditolak')
            <div class="grid md:grid-cols-2 gap-6 mb-8">
              <!-- Next Steps Card -->
              <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                <div class="flex items-center mb-4">
                  <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                  </div>
                  <h3 class="text-lg font-semibold text-gray-900">
                    @if ($pendaftaran->status === 'diterima')
                      Langkah Selanjutnya
                    @else
                      Proses Selanjutnya
                    @endif
                  </h3>
                </div>
                <ul class="text-sm text-gray-600 space-y-2">
                  @if ($pendaftaran->status === 'diterima')
                    <li class="flex items-start">
                      <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                      Tim akan menghubungi Anda dalam 1-2 hari kerja
                    </li>
                    <li class="flex items-start">
                      <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                      Persiapkan dokumen yang diperlukan
                    </li>
                    <li class="flex items-start">
                      <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                      Orientasi dan pengenalan tim
                    </li>
                  @else
                    <li class="flex items-start">
                      <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                      Tim HR sedang meninjau aplikasi Anda
                    </li>
                    <li class="flex items-start">
                      <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                      Anda akan dihubungi dalam 3-5 hari kerja
                    </li>
                    <li class="flex items-start">
                      <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                      Proses interview akan dijadwalkan jika lolos seleksi
                    </li>
                  @endif
                </ul>
              </div>

              <!-- Contact Info Card -->
              <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-100">
                <div class="flex items-center mb-4">
                  <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                  </div>
                  <h3 class="text-lg font-semibold text-gray-900">Kontak Kami</h3>
                </div>
                <div class="text-sm text-gray-600 space-y-2">
                  <p class="flex items-center">
                    <span class="mr-2">📧</span>
                    <a href="mailto:info@company.com" class="text-green-600 hover:underline">info@company.com</a>
                  </p>
                  <p class="flex items-center">
                    <span class="mr-2">📱</span>
                    <a href="tel:+62812345678" class="text-green-600 hover:underline">+62 812 3456 789</a>
                  </p>
                  <p class="text-xs text-gray-500 mt-3">
                    Hubungi kami jika ada pertanyaan mengenai aplikasi Anda
                  </p>
                </div>
              </div>
            </div>
          @endif

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('home') }}"
              class="bg-primary text-white font-semibold py-3 px-8 rounded-xl hover:bg-[#00295a] transition-colors flex items-center">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              Kembali ke Beranda
            </a>

            @if ($pendaftaran->status !== 'ditolak')
              <button onclick="window.print()"
                class="bg-gray-100 text-gray-700 font-semibold py-3 px-8 rounded-xl hover:bg-gray-200 transition-colors flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Status
              </button>
            @endif
          </div>

          <!-- Refresh Note -->
          @if ($pendaftaran->status === 'pending' || $pendaftaran->status === 'diproses')
            <div class="mt-8 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
              <p class="text-sm text-yellow-800 text-center">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Status akan terus diperbarui secara otomatis. Refresh halaman untuk melihat update terbaru.
              </p>
            </div>
          @endif
        </div>
      @else
        <!-- Form Header -->
        <div class="bg-primary p-8 text-white">
          <div class="text-center">
            <div
              class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
            </div>
            <h2 class="text-3xl font-bold mb-2">Formulir Pendaftaran</h2>
            <p class="text-indigo-100 text-lg font-medium">Isi data diri Anda dengan lengkap dan benar</p>
          </div>
        </div>

        <!-- Form Content -->
        <form action="{{ route('daftar-magang.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-8">
          @csrf
          <!-- Personal Information Section -->
          <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-6 border border-indigo-100">
            <div class="flex items-center mb-6">
              <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900">Informasi Pribadi</h3>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
              <!-- Nama Lengkap -->
              <div>
                <div class="flex items-center mb-2">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                  <x-input-label for="name" :value="__('Nama Lengkap')" />
                </div>
                <x-text-input id="name" class="w-full px-4 py-3 rounded-xl bg-white/80" type="text"
                  name="name" :value="old('name', Auth::user()->name)" required readonly />
              </div>

              <!-- Email -->
              <div>
                <div class="flex items-center mb-2">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                  <x-input-label for="email" :value="__('Email')" />
                </div>
                <x-text-input id="email" class="w-full px-4 py-3 rounded-xl bg-white/80" type="email"
                  name="email" :value="old('email', Auth::user()->email)" required readonly />
              </div>
            </div>

            <!-- No HP -->
            <div class="mt-6">
              <div class="flex items-center mb-2">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <x-input-label for="no_hp" :value="__('Nomor WhatsApp')" />
              </div>
              <x-text-input id="no_hp" class="w-full px-4 py-3 rounded-xl bg-white/80" type="text"
                name="no_hp" :value="old('no_hp', Auth::user()->no_hp)" required readonly />
            </div>
          </div>

          <!-- Documents Section -->
          <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
            <div class="flex items-center mb-6">
              <div class="w-10 h-10 bg-green-600 rounded-xl flex items-center justify-center mr-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900">Dokumen Pendukung</h3>
            </div>

            <!-- File CV -->
            <div class="mb-4">
              <div class="flex items-center mb-2">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <x-input-label for="cv_file" :value="__('Upload CV (PDF, DOC, DOCX) *')" />
              </div>
              <x-text-input id="cv_file"
                class="w-full px-4 py-3 border rounded-xl bg-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                accept=".pdf,.doc,.docx" type="file" name="cv_file" required />

              <p class="mt-4 text-xs text-gray-500">Maksimal ukuran file 5MB. Format: PDF, DOC, atau DOCX</p>
              <x-input-error :messages="$errors->get('cv_file')" class="mt-2" />
            </div>
            <!-- Surat Motivasi -->
            <div class="group">
              <div class="flex items-center mb-2">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <x-input-label for="surat_motivasi" :value="__('Surat Motivasi (Optional)')" />
              </div>
              <textarea id="surat_motivasi" name="surat_motivasi" rows="6"
                class="w-full px-4 py-3 border rounded-xl shadow-sm focus:border-primary focus:ring-primary bg-white resize-none"
                placeholder="Ceritakan motivasi Anda untuk mengikuti program magang ini. Jelaskan tujuan karir Anda, keahlian yang ingin dikembangkan, dan bagaimana program ini akan membantu mencapai tujuan tersebut."></textarea>
              <x-input-error :messages="$errors->get('surat_motivasi')" class="mt-2" />
            </div>
          </div>

          <!-- Agreement Section -->
          <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
            <div class="flex items-start">
              <input type="checkbox" id="is_agreed" name="is_agreed" required
                class="mt-1 h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
              <label for="is_agreed" class="ml-3 text-sm text-gray-700">
                <span class="font-semibold">Persetujuan & Pernyataan</span>
                <br>
                Saya menyatakan bahwa data dan informasi yang saya berikan adalah benar dan dapat
                dipertanggungjawabkan. Saya memahami bahwa memberikan informasi palsu dapat mengakibatkan pembatalan
                pendaftaran. Saya juga menyetujui untuk dihubungi melalui email atau nomor telepon yang telah saya
                berikan untuk keperluan proses seleksi.
              </label>
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" id="submitBtn" disabled
            class="w-full bg-primary text-white font-bold py-4 px-8 rounded-xl flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed hover:bg-[#00295a]">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
            </svg>
            <span class="text-lg">Daftar</span>
          </button>

          <!-- Help Text -->
          <div class="text-center">
            <p class="text-sm text-gray-600">
              Butuh bantuan? Hubungi kami di
              <a href="mailto:info@company.com"
                class="text-primary hover:underline font-semibold">info@company.com</a>
              atau
              <a href="tel:+62812345678" class="text-primary hover:underline font-semibold">+62
                812 3456 789</a>
            </p>
          </div>
        </form>
      @endif
    </div>
  </section>
  <x-footer class="fill-[#EEF0F2]" />

  @unless (isset($pendaftaran) && $pendaftaran)
    <script>
      // Character Counter Script
      document.addEventListener('DOMContentLoaded', function() {
        // Tombol submit bisa ditekan ketika checkbox dicentang
        const checkbox = document.getElementById('is_agreed');
        const submitBtn = document.getElementById('submitBtn');

        // Fungsi untuk mengaktifkan atau menonaktifkan tombol
        function toggleSubmitButton() {
          submitBtn.disabled = !checkbox.checked;
        }

        // Jalankan saat checkbox berubah
        checkbox.addEventListener('change', toggleSubmitButton);

        // Pastikan tombol disabled saat halaman dimuat
        toggleSubmitButton();
      });
    </script>
  @endunless
</x-layout-web>
