@if ($paginator->hasPages())
    <nav class="paginationNav">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="leftArr disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                </li>
            @else
                <li class="leftArr">
                    <button wire:click="previousPage" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-angle-left"></i>
                    </button>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled smHidden" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li class="smHidden"><button wire:click="gotoPage({{$page}})">{{ $page }}</button></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="rightArr">
                    <button wire:click="nextPage" rel="next" aria-label="@lang('pagination.next')">
                        <i class="fas fa-angle-right"></i>
                    </button>
                </li>
            @else
                <li class="rightArr disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif