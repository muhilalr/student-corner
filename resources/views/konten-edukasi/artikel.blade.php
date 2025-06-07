<x-layout-web>
  <section class="w-full px-36 py-16">
    @foreach ($artikel->subjudul_artikel as $sub)
      <h1 class="text-2xl font-bold">{{ $sub->sub_judul }}</h1>

      @foreach ($sub->detail_sub_judul_artikel as $d)
        <p class="mt-4">{{ $d->konten_text }}</p>
        {!! $d->link_embed !!}
      @endforeach
    @endforeach

  </section>
  <x-footer class="fill-[#EEF0F2]" />
</x-layout-web>
