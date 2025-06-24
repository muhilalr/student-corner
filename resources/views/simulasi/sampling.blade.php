<x-layout-web>
  <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-4 text-orange-600">Simulasi Distribusi Sampling</h2>

    <form method="POST" action="{{ route('simulasi.sampling.run') }}">
      @csrf
      <div class="grid grid-cols-1 gap-4 mb-4">
        <div>
          <label class="font-semibold">Populasi (pisahkan dengan koma)</label>
          <textarea name="populasi" class="w-full p-2 border rounded mt-1" rows="3" placeholder="Contoh: 70,80,90,85,60,95,100">{{ old('populasi', $populasiInput ?? '') }}</textarea>
          @error('populasi')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label class="font-semibold">Ukuran Sample</label>
          <input type="number" name="ukuran_sample" class="w-full p-2 border rounded mt-1"
            value="{{ old('ukuran_sample', $ukuranSample ?? 3) }}">
          @error('ukuran_sample')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label class="font-semibold">Jumlah Pengulangan</label>
          <input type="number" name="jumlah_pengulangan" class="w-full p-2 border rounded mt-1"
            value="{{ old('jumlah_pengulangan', $jumlahPengulangan ?? 5) }}">
          @error('jumlah_pengulangan')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>
      <button class="bg-primary text-white px-4 py-2 rounded hover:bg-[#00295A] transition">Jalankan
        Simulasi</button>
    </form>

    @if (isset($hasilSimulasi))
      <div class="mt-8">
        <h3 class="text-xl font-semibold mb-2 text-gray-700">Hasil Simulasi ({{ $jumlahPengulangan }} kali)</h3>
        <table class="w-full table-auto border border-gray-300 mt-2 text-sm">
          <thead class="bg-gray-100">
            <tr>
              <th class="border px-4 py-2">Pengulangan Ke</th>
              <th class="border px-4 py-2">Sample</th>
              <th class="border px-4 py-2">Mean</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($hasilSimulasi as $hasil)
              <tr>
                <td class="border px-4 py-2 text-center">{{ $hasil['ke'] }}</td>
                <td class="border px-4 py-2 text-center">{{ implode(', ', $hasil['sample']) }}</td>
                <td class="border px-4 py-2 text-center text-blue-600 font-semibold">{{ $hasil['mean'] }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

  <x-footer class="fill-[#EEF0F2]" />
</x-layout-web>
