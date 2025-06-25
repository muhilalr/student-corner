<x-layout-web>
  <div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-white max-w-6xl mx-auto rounded-lg shadow-sm p-6 mb-6">
      <div class="flex items-center space-x-4">
        <div class="bg-yellow-400 rounded-lg p-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
            <!-- Garis bar di atas huruf x -->
            <line x1="8" y1="6" x2="16" y2="6" stroke="white" stroke-width="2" />
            <!-- Huruf x -->
            <text x="6" y="20" font-size="18" font-family="Arial" fill="white">x</text>
          </svg>
        </div>
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Kalkulator Mean, Median, Modus</h1>
          <p class="text-gray-600 text-sm text-justify">Alat praktis untuk menghitung mean, median, dan modus dari data
            Anda dengan mudah.</p>
        </div>
      </div>
    </div>
    <div class="max-w-6xl mx-auto">

      <!-- Input Section -->
      <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Set Data</h2>

        <div class="mb-4">
          <textarea id="dataInput" placeholder="10, 2, 38, 23, 38, 23, 21, 234"
            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
            rows="3"></textarea>
          <p class="text-xs text-gray-500 mt-1">Angka dipisahkan dengan koma</p>
        </div>

        <button id="calculateBtn"
          class="gradient-bg text-white px-8 py-2 rounded-lg font-medium hover:opacity-90 transition-opacity">
          Hitung
        </button>

        {{-- Result Section --}}
        <div class="bg-primary rounded-t-lg p-4 mb-4">
          <h2 class="text-center text-white font-semibold tracking-wide">Hasil</h2>
        </div>



        <!-- Statistics Grid -->

        <div class="max-w-xs mx-auto space-y-3">
          <div class="flex justify-between items-center py-3 border-b border-primary">
            <span class="font-medium text-black">Jumlah</span>
            <span id="sum" class="font-mono text-black">-</span>
          </div>
          <div class="flex justify-between items-center py-3 border-b border-primary">
            <span class="font-medium text-black">Banyak Data</span>
            <span id="count" class="font-mono text-black">-</span>
          </div>
          <div class="flex justify-between items-center py-3 border-b border-primary">
            <span class="font-medium text-black">Rata-rata (Mean)</span>
            <span id="mean" class="font-mono text-black">-</span>
          </div>
          <div class="flex justify-between items-center py-3 border-b border-primary">
            <span class="font-medium text-black">Median</span>
            <span id="median" class="font-mono text-black">-</span>
          </div>
          <div class="flex justify-between items-center py-3 border-b border-primary">
            <span class="font-medium text-black">Modus</span>
            <span id="mode" class="font-mono text-black">-</span>
          </div>
          <div class="flex justify-between items-center py-3 border-b border-primary">
            <span class="font-medium text-black">Terbesar</span>
            <span id="max" class="font-mono text-black">-</span>
          </div>
          <div class="flex justify-between items-center py-3 border-b border-primary">
            <span class="font-medium text-black">Terkecil</span>
            <span id="min" class="font-mono text-black">-</span>
          </div>
        </div>
      </div>

    </div>
  </div>
  <x-footer class="fill-[#EEF0F2]" />

  <script>
    class MeanCalculator {
      constructor() {
        this.dataInput = document.getElementById('dataInput');
        this.calculateBtn = document.getElementById('calculateBtn');
        this.initializeEventListeners();

        // Set example data
        this.dataInput.value = '10, 2, 38, 23, 38, 23, 21, 234';
        this.calculate();
      }

      initializeEventListeners() {
        this.calculateBtn.addEventListener('click', () => this.calculate());
        this.dataInput.addEventListener('input', () => this.calculate());
        this.dataInput.addEventListener('keypress', (e) => {
          if (e.key === 'Enter') {
            e.preventDefault();
            this.calculate();
          }
        });
      }

      parseData(input) {
        if (!input.trim()) return [];

        return input.split(',')
          .map(item => item.trim())
          .filter(item => item !== '')
          .map(item => parseFloat(item))
          .filter(num => !isNaN(num));
      }

      calculateMean(data) {
        if (data.length === 0) return 0;
        const sum = data.reduce((acc, num) => acc + num, 0);
        return sum / data.length;
      }

      calculateMedian(data) {
        if (data.length === 0) return 0;

        const sorted = [...data].sort((a, b) => a - b);
        const middle = Math.floor(sorted.length / 2);

        if (sorted.length % 2 === 0) {
          return (sorted[middle - 1] + sorted[middle]) / 2;
        } else {
          return sorted[middle];
        }
      }

      calculateMode(data) {
        if (data.length === 0) return '-';

        // Count frequency of each number
        const frequency = {};
        data.forEach(num => {
          frequency[num] = (frequency[num] || 0) + 1;
        });

        // Find maximum frequency
        const maxFrequency = Math.max(...Object.values(frequency));

        // If all numbers appear only once, there's no mode
        if (maxFrequency === 1) {
          return 'Tidak ada';
        }

        // Find all numbers with maximum frequency
        const modes = Object.keys(frequency)
          .filter(num => frequency[num] === maxFrequency)
          .map(num => parseFloat(num))
          .sort((a, b) => a - b);

        // Format the result
        if (modes.length === 1) {
          return this.formatNumber(modes[0]);
        } else {
          return modes.map(num => this.formatNumber(num)).join(', ');
        }
      }

      calculateGeometricMean(data) {
        if (data.length === 0) return 0;

        // Check for negative numbers or zeros
        const hasNegativeOrZero = data.some(num => num <= 0);
        if (hasNegativeOrZero) return 0;

        const product = data.reduce((acc, num) => acc * num, 1);
        return Math.pow(product, 1 / data.length);
      }

      formatNumber(num) {
        if (num === 0) return '0';
        if (Number.isInteger(num)) return num.toString();

        // For very small numbers, use more decimal places
        if (Math.abs(num) < 0.001) {
          return num.toFixed(8);
        }

        // For normal numbers, use appropriate decimal places
        const decimalPlaces = num.toString().split('.')[1];
        if (decimalPlaces && decimalPlaces.length > 3) {
          return num.toFixed(8);
        }

        return num.toString();
      }

      updateDisplay(data) {
        if (data.length === 0) {
          this.clearDisplay();
          return;
        }

        const sum = data.reduce((acc, num) => acc + num, 0);
        const count = data.length;
        const mean = this.calculateMean(data);
        const median = this.calculateMedian(data);
        const mode = this.calculateMode(data);
        const max = Math.max(...data);
        const min = Math.min(...data);

        // Update statistics
        document.getElementById('sum').textContent = this.formatNumber(sum);
        document.getElementById('count').textContent = count.toString();
        document.getElementById('mean').textContent = this.formatNumber(mean);
        document.getElementById('median').textContent = this.formatNumber(median);
        document.getElementById('mode').textContent = mode;
        document.getElementById('max').textContent = this.formatNumber(max);
        document.getElementById('min').textContent = this.formatNumber(min);
      }

      clearDisplay() {
        const elements = [
          'sum', 'count', 'mean', 'median', 'mode',
          'max', 'min'
        ];

        elements.forEach(id => {
          document.getElementById(id).textContent = '-';
        });
      }

      calculate() {
        const inputValue = this.dataInput.value;
        const data = this.parseData(inputValue);
        this.updateDisplay(data);
      }
    }

    // Initialize calculator when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
      new MeanCalculator();
    });
  </script>
</x-layout-web>
