<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Di dalam <head> -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Accessibility Styles -->
  <style>
    /* Accessibility Custom Styles */
    .accessibility-cursor {
      cursor: url('https://cdn.jsdelivr.net/gh/jamestomasino/big-cursor/cursors/cursor-large.cur'), auto !important;
    }


    .high-saturation {
      filter: saturate(200%) !important;
    }

    .low-saturation {
      filter: saturate(50%) !important;
    }

    .monochrome {
      filter: grayscale(100%) !important;
    }

    /* Accessibility button animation */
    .accessibility-btn {
      transition: all 0.3s ease;
    }

    .accessibility-btn:hover {
      transform: scale(1.1);
    }

    /* Modal animation */
    .accessibility-modal {
      transition: all 0.3s ease;
    }

    .accessibility-modal.show {
      opacity: 1;
      visibility: visible;
    }

    .accessibility-modal.hide {
      opacity: 0;
      visibility: hidden;
    }
  </style>

  <title>Student Corner</title>
</head>

<body class="bg-[#EEF0F2]" id="main-body">
  <div id="accessibilityWrapper">
    <x-navbar />
    {{ $slot }}
  </div>

  <!-- Accessibility Button -->
  <div class="fixed bottom-6 left-6 z-50">
    <button id="accessibilityBtn"
      class="accessibility-btn bg-button text-white p-4 rounded-full shadow-lg hover:bg-[#02a66b] transition-colors">
      <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
        <path
          d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
      </svg>
    </button>
  </div>

  <!-- Accessibility Menu Modal -->
  <div id="accessibilityModal" class="accessibility-modal hide fixed top-24 left-20 z-50">
    <div class="bg-zinc-100 rounded-lg p-6 max-w-md w-full mx-4 max-h-[70vh] overflow-y-auto">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">Menu Aksesibilitas</h2>
        <button id="closeModal" class="text-gray-500 hover:text-gray-700">
          <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path
              d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
          </svg>
        </button>
      </div>

      <!-- Content Adjustment Section -->
      <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Penyesuaian Konten</h3>

        <!-- Font Size Control -->
        <div class="mb-4">
          <div class="flex items-center justify-between mb-2">
            <span class="text-gray-700">Zoom</span>
            <span id="fontPercentage" class="text-button font-semibold">100%</span>
          </div>
          <div class="flex items-center space-x-4">
            <button id="decreaseFont"
              class="bg-button text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#02a66b]">
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 13H5v-2h14v2z" />
              </svg>
            </button>
            <div class="flex-1 text-center">
              <span id="fontSizeDisplay" class="text-sm">100%</span>
            </div>
            <button id="increaseFont"
              class="bg-button text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#02a66b]">
              <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Accessibility Options -->
        <div class="space-y-3">
          <!-- Big Cursor -->
          <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
              <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" class="text-blue-600">
                  <path
                    d="M13.64 21.97c-.21 0-.42-.05-.61-.15-.37-.19-.64-.54-.64-.94V15.6l-2.24-2.24c-.61-.61-.61-1.6 0-2.21L17.5 3.8c.61-.61 1.6-.61 2.21 0 .61.61.61 1.6 0 2.21l-7.35 7.35 2.24 2.24h5.28c.4 0 .75.27.94.64.19.37.14.81-.13 1.13l-6.72 4.48c-.18.12-.39.18-.61.18z" />
                </svg>
              </div>
              <div>
                <div class="font-medium text-gray-800">Kursor Perbesar</div>
              </div>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input id="bigCursor" type="checkbox" class="sr-only peer">
              <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-button rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-button">
              </div>
            </label>
          </div>

          <!-- High Saturation -->
          <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
              <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" class="text-green-600">
                  <path
                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                </svg>
              </div>
              <div>
                <div class="font-medium text-gray-800">Saturasi Tinggi</div>
              </div>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input id="highSaturation" type="checkbox" class="sr-only peer" name="saturation">
              <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-button rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-button">
              </div>
            </label>
          </div>

          <!-- Low Saturation -->
          <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
              <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" class="text-yellow-600">
                  <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                </svg>
              </div>
              <div>
                <div class="font-medium text-gray-800">Saturasi Rendah</div>
              </div>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input id="lowSaturation" type="checkbox" class="sr-only peer" name="saturation">
              <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-button rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-button">
              </div>
            </label>
          </div>

          <!-- Monochrome -->
          <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
            <div class="flex items-center space-x-3">
              <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" class="text-gray-600">
                  <path
                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                </svg>
              </div>
              <div>
                <div class="font-medium text-gray-800">Monokrom</div>
              </div>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input id="monochrome" type="checkbox" class="sr-only peer" name="saturation">
              <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-button rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-button">
              </div>
            </label>
          </div>
        </div>
      </div>

      <!-- Reset Button -->
      <div class="mb-4">
        <button id="resetAll"
          class="w-full bg-primary text-white py-3 px-4 rounded-lg hover:bg-[#00295A] transition-colors">
          Reset Semua Pengaturan
        </button>
      </div>

      <!-- Footer -->
      <div class="text-center text-sm text-gray-500">
        <p>Accessibility Widget by Student Corner</p>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();

    function toggleMenu() {
      const mobileMenu = document.getElementById('mobile-menu');
      const hamburgerIcon = document.getElementById('hamburger-icon');
      const closeIcon = document.getElementById('close-icon');

      mobileMenu.classList.toggle('hidden');
      hamburgerIcon.classList.toggle('hidden');
      closeIcon.classList.toggle('hidden');
    }

    // Accessibility functionality
    let currentFontSize = 100;
    let currentSaturation = 'normal';
    let bigCursorActive = false;

    // DOM Elements
    const accessibilityBtn = document.getElementById('accessibilityBtn');
    const accessibilityModal = document.getElementById('accessibilityModal');
    const closeModal = document.getElementById('closeModal');
    const decreaseFont = document.getElementById('decreaseFont');
    const increaseFont = document.getElementById('increaseFont');
    const fontPercentage = document.getElementById('fontPercentage');
    const fontSizeDisplay = document.getElementById('fontSizeDisplay');
    const bigCursorToggle = document.getElementById('bigCursor');
    const highSaturationToggle = document.getElementById('highSaturation');
    const lowSaturationToggle = document.getElementById('lowSaturation');
    const monochromeToggle = document.getElementById('monochrome');
    const resetAll = document.getElementById('resetAll');
    const mainBody = document.getElementById('main-body');

    // Load saved settings when page loads
    document.addEventListener('DOMContentLoaded', function() {
      loadSettings();
    });

    // Event Listeners
    accessibilityBtn.addEventListener('click', () => {
      accessibilityModal.classList.remove('hide');
      accessibilityModal.classList.add('show');
    });

    closeModal.addEventListener('click', () => {
      accessibilityModal.classList.remove('show');
      accessibilityModal.classList.add('hide');
    });

    accessibilityModal.addEventListener('click', (e) => {
      if (e.target === accessibilityModal) {
        accessibilityModal.classList.remove('show');
        accessibilityModal.classList.add('hide');
      }
    });

    // Font size controls
    decreaseFont.addEventListener('click', () => {
      if (currentFontSize > 80) {
        currentFontSize -= 10;
        applyFontSize();
      }
    });

    increaseFont.addEventListener('click', () => {
      if (currentFontSize < 150) {
        currentFontSize += 10;
        applyFontSize();
      }
    });

    // Big cursor toggle
    bigCursorToggle.addEventListener('change', () => {
      bigCursorActive = bigCursorToggle.checked;
      applyBigCursor();
      saveSettings();
    });

    // Saturation controls
    highSaturationToggle.addEventListener('change', () => {
      if (highSaturationToggle.checked) {
        lowSaturationToggle.checked = false;
        monochromeToggle.checked = false;
        currentSaturation = 'high';
      } else {
        currentSaturation = 'normal';
      }
      applySaturation();
      saveSettings();
    });

    lowSaturationToggle.addEventListener('change', () => {
      if (lowSaturationToggle.checked) {
        highSaturationToggle.checked = false;
        monochromeToggle.checked = false;
        currentSaturation = 'low';
      } else {
        currentSaturation = 'normal';
      }
      applySaturation();
      saveSettings();
    });

    monochromeToggle.addEventListener('change', () => {
      if (monochromeToggle.checked) {
        highSaturationToggle.checked = false;
        lowSaturationToggle.checked = false;
        currentSaturation = 'mono';
      } else {
        currentSaturation = 'normal';
      }
      applySaturation();
      saveSettings();
    });

    // Reset all settings
    resetAll.addEventListener('click', () => {
      currentFontSize = 100;
      currentSaturation = 'normal';
      bigCursorActive = false;

      // Reset UI
      bigCursorToggle.checked = false;
      highSaturationToggle.checked = false;
      lowSaturationToggle.checked = false;
      monochromeToggle.checked = false;

      // Apply changes
      applyFontSize();
      applySaturation();
      applyBigCursor();
      saveSettings();
    });

    // Functions
    function applyFontSize() {
      const percentage = currentFontSize / 100;
      document.documentElement.style.fontSize = `${16 * percentage}px`;
      fontPercentage.textContent = `${currentFontSize}%`;
      fontSizeDisplay.textContent = `${currentFontSize}%`;
      saveSettings();
    }

    function applyBigCursor() {
      if (bigCursorActive) {
        mainBody.classList.add('accessibility-cursor');
      } else {
        mainBody.classList.remove('accessibility-cursor');
      }
    }

    function applySaturation() {
      const wrapper = document.getElementById('accessibilityWrapper');
      wrapper.classList.remove('high-saturation', 'low-saturation', 'monochrome');

      switch (currentSaturation) {
        case 'high':
          wrapper.classList.add('high-saturation');
          break;
        case 'low':
          wrapper.classList.add('low-saturation');
          break;
        case 'mono':
          wrapper.classList.add('monochrome');
          break;
      }

    }

    function saveSettings() {
      const settings = {
        fontSize: currentFontSize,
        saturation: currentSaturation,
        bigCursor: bigCursorActive
      };

      // Simpan ke localStorage
      localStorage.setItem('studentCornerAccessibility', JSON.stringify(settings));
    }

    function loadSettings() {
      // Load dari localStorage
      const savedSettings = localStorage.getItem('studentCornerAccessibility');

      const settings = savedSettings ? JSON.parse(savedSettings) : {
        fontSize: 100,
        saturation: 'normal',
        bigCursor: false
      };

      currentFontSize = settings.fontSize;
      currentSaturation = settings.saturation;
      bigCursorActive = settings.bigCursor;

      // Apply settings
      applyFontSize();
      applySaturation();
      applyBigCursor();

      // Update UI
      bigCursorToggle.checked = bigCursorActive;

      switch (currentSaturation) {
        case 'high':
          highSaturationToggle.checked = true;
          break;
        case 'low':
          lowSaturationToggle.checked = true;
          break;
        case 'mono':
          monochromeToggle.checked = true;
          break;
      }
    }
  </script>
</body>

</html>
