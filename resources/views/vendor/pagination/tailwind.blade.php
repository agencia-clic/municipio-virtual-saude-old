@if($paginator->hasPages())
    <div class="card-footer d-flex align-items-center justify-content-center">

        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous"><span class="fas fa-chevron-left"></span></button>
            </a>
        @else
            <button class="btn btn-sm btn-falcon-default me-1 disabled" type="button" title="Previous"><span class="fas fa-chevron-left"></span></button>
        @endif

        <ul class="pagination mb-0">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item"><a class="page-link" title="»">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">
                                <button class="page" type="button">{{ $page }}</button>
                            </li>
                        @else
                            <li>
                                <a aria-label="{{ __('Go to page :page', ['page' => $page]) }}" href="{{ $url }}"><button class="page" type="button">{{ $page }}</button></a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                <button class="btn btn-sm btn-falcon-default ms-1" type="button" aria-label="@lang('pagination.next')" title="Next"><span class="fas fa-chevron-right"></span></button>
            </a>
        @else
            <button class="btn btn-sm btn-falcon-default ms-1 disabled" type="button" aria-label="@lang('pagination.next')" title="Next"><span class="fas fa-chevron-right"></span></button>
        @endif
    </div>
@endif
