@if ($paginator->hasPages())
<ul class="pagination justify-content-center">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span aria-hidden="true"><i class="la la-arrow-left"></i></span>
            <span class="sr-only">Previous</span>
        </li>
    @else
        <li>
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
    @endif
{{--    <li class="page-item">--}}
{{--        <a class="page-link" href="#" aria-label="Previous">--}}
{{--            <span aria-hidden="true"><i class="la la-arrow-left"></i></span>--}}
{{--            <span class="sr-only">Previous</span>--}}
{{--        </a>--}}
{{--    </li>--}}

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active" aria-current="page"><span>{{ $page }}</span></li>
                @else
                    <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

{{--    <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--    <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}


    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li>
    @else
        <li class="page-link" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span aria-hidden="true"><i class="la la-arrow-right"></i></span>
            <span class="sr-only">Next</span>
        </li>
    @endif
{{--    --}}
{{--    <li class="page-item">--}}
{{--        <a class="page-link" href="#" aria-label="Next">--}}
{{--            <span aria-hidden="true"><i class="la la-arrow-right"></i></span>--}}
{{--            <span class="sr-only">Next</span>--}}
{{--        </a>--}}
{{--    </li>--}}
</ul>
    @endif
