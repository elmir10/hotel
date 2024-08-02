@if ($paginator->hasPages())

<div class="room-pagination">
    @if ($paginator->onFirstPage())
        <a class="disabled" aria-disabled="true" style="cursor: pointer;" disabled aria-label="@lang('pagination.previous')">
            <span aria-hidden="true"><i class="fa fa-long-arrow-left"></i></span>
        </a>
    @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="fa fa-long-arrow-left"></i></a>
    @endif

    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <a class="disabled" aria-disabled="true"><span>{{ $element }}</span></a>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="active" style="background-color: #d7ab7b; color: white;" aria-current="page"><span>{{ $page }}</span></a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="fa fa-long-arrow-right"></i></a>
    @else
        <a class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span aria-hidden="true"><i class="fa fa-long-arrow-right"></i></span>
        </a>
    @endif
</div>


@endif