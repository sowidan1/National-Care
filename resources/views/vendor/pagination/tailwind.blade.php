<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-1">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="px-3 py-1 rounded bg-gray-200 text-gray-400 cursor-not-allowed">&lt;</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 rounded bg-white border border-gray-300 hover:bg-gray-100">&lt;</a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="px-3 py-1">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="px-3 py-1 rounded bg-blue-600 text-white font-semibold">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-3 py-1 rounded bg-white border border-gray-300 hover:bg-gray-100">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 rounded bg-white border border-gray-300 hover:bg-gray-100">&gt;</a>
    @else
        <span class="px-3 py-1 rounded bg-gray-200 text-gray-400 cursor-not-allowed">&gt;</span>
    @endif
</nav>
