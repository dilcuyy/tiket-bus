@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center items-center space-x-3 py-4 font-sans text-sm text-gray-700">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span class="px-3 py-1 rounded-md bg-gray-200 text-gray-400 cursor-not-allowed select-none">
            &larr; Prev
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-3 py-1 rounded-md hover:bg-gray-300 hover:text-gray-900 transition">
            &larr; Prev
        </a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="px-3 py-1 select-none text-gray-400">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span aria-current="page" class="px-4 py-1 rounded-full bg-black text-white font-semibold select-none shadow-sm">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}" class="px-4 py-1 rounded-full hover:bg-gray-100 hover:text-black transition">
                        {{ $page }}
                    </a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-3 py-1 rounded-md hover:bg-gray-300 hover:text-gray-900 transition">
            Next &rarr;
        </a>
    @else
        <span class="px-3 py-1 rounded-md bg-gray-200 text-gray-400 cursor-not-allowed select-none">
            Next &rarr;
        </span>
    @endif
</nav>
@endif
