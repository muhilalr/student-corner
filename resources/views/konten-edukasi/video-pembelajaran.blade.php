<x-layout-web>
  <section class="w-full px-36 py-16">
    <h1 class="text-2xl font-bold mb-4">{{ $video->judul }}</h1>
    <p class="mb-4">{{ $video->deskripsi }}</p>
    <iframe src="{{ $video->embed_link }}" width="100%" height="500" frameborder="0" allowfullscreen></iframe>

  </section>
  <x-footer class="fill-[#EEF0F2]" />
</x-layout-web>
