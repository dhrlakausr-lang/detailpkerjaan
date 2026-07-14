@if ($paginator->hasPages())
    <ul class="flex list-none items-center gap-1.5">
        {{-- Prev --}}
        @if ($paginator->onFirstPage())
            <li><span class="flex h-[38px] min-w-[38px] cursor-not-allowed items-center justify-center rounded-[9px] border-[1.5px] border-[#e2e8f0] bg-white px-2.5 text-sm font-semibold text-[#334155] opacity-40"><i class="fas fa-chevron-left"></i></span></li>
        @else
            <li><a class="flex h-[38px] min-w-[38px] items-center justify-center rounded-[9px] border-[1.5px] border-[#e2e8f0] bg-white px-2.5 text-sm font-semibold text-[#334155] no-underline transition-all duration-200 hover:border-[#2563eb] hover:bg-[#eff6ff] hover:text-[#2563eb]" href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a></li>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li><span class="flex h-[38px] min-w-[38px] cursor-not-allowed items-center justify-center rounded-[9px] border-[1.5px] border-[#e2e8f0] bg-white px-2.5 text-sm font-semibold text-[#334155] opacity-40">{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><span class="flex h-[38px] min-w-[38px] items-center justify-center rounded-[9px] border-[1.5px] border-[#2563eb] bg-[#2563eb] px-2.5 text-sm font-semibold text-white">{{ $page }}</span></li>
                    @else
                        <li><a class="flex h-[38px] min-w-[38px] items-center justify-center rounded-[9px] border-[1.5px] border-[#e2e8f0] bg-white px-2.5 text-sm font-semibold text-[#334155] no-underline transition-all duration-200 hover:border-[#2563eb] hover:bg-[#eff6ff] hover:text-[#2563eb]" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li><a class="flex h-[38px] min-w-[38px] items-center justify-center rounded-[9px] border-[1.5px] border-[#e2e8f0] bg-white px-2.5 text-sm font-semibold text-[#334155] no-underline transition-all duration-200 hover:border-[#2563eb] hover:bg-[#eff6ff] hover:text-[#2563eb]" href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a></li>
        @else
            <li><span class="flex h-[38px] min-w-[38px] cursor-not-allowed items-center justify-center rounded-[9px] border-[1.5px] border-[#e2e8f0] bg-white px-2.5 text-sm font-semibold text-[#334155] opacity-40"><i class="fas fa-chevron-right"></i></span></li>
        @endif
    </ul>
@endif
