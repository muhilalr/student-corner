@if ($paginator->hasPages())
  <nav class="mt-6 flex justify-center">
    <ul class="inline-flex items-center -space-x-px text-sm">
      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
        <li class="px-3 py-2 text-gray-400 bg-white border border-gray-300 rounded-l-lg">‹</li>
      @else
        <li>
          <a href="{{ $paginator->previousPageUrl() }}"
            class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100">‹</a>
        </li>
      @endif

      {{-- Pagination Elements --}}
      @foreach ($elements as $element)
        @if (is_string($element))
          <li class="px-3 py-2 text-gray-500 bg-white border border-gray-300">{{ $element }}</li>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li class="px-3 py-2 text-white bg-primary border border-primary">{{ $page }}</li>
            @else
              <li>
                <a href="{{ $url }}"
                  class="px-3 py-2 text-gray-700 bg-white border border-gray-300 hover:bg-gray-100">{{ $page }}</a>
              </li>
            @endif
          @endforeach
        @endif
      @endforeach

      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
        <li>
          <a href="{{ $paginator->nextPageUrl() }}"
            class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100">›</a>
        </li>
      @else
        <li class="px-3 py-2 text-gray-400 bg-white border border-gray-300 rounded-r-lg">›</li>
      @endif
    </ul>
  </nav>
@endif
