@if ($paginator->hasPages())
    <!-- Pagination -->
    <nav id="datatablePagination" aria-label="Activity pagination" style="">
        <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
            <ul id="datatable_pagination" class="pagination datatable-custom-pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="paginate_item page-item disabled">
                        <span class="paginate_button previous page-link" aria-hidden="true">Prev</span>
                    </li>
                @else
                    <li class="paginate_item page-item">
                        <a class="paginate_button previous page-link" href="{{ $paginator->previousPageUrl() }}">
                            <span aria-hidden="true">Prev</span>
                        </a>
                    </li>
                @endif

                @if (Agent::isMobile())
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="paginate_item page-item active">
                                        <a class="paginate_button page-link">{{ $page }}</a>
                                    </li>
                                @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                                    <li class="paginate_item page-item">
                                        <a class="paginate_button page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @elseif ($page == $paginator->lastPage() - 1)
                                    <li class="disabled">
                                        <span class="ellipsis page-link">…</span>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @else
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="paginate_item page-item" aria-disabled="true">
                                <a class="paginate_button page-link">{{ $element }}</a>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="paginate_item page-item active">
                                        <a class="paginate_button page-link">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="paginate_item page-item">
                                        <a class="paginate_button page-link" href="{{ $url }}"
                                           aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="paginate_item page-item">
                        <a class="paginate_button next page-link" href="{{ $paginator->nextPageUrl() }}">
                            <span aria-hidden="true">Next</span>
                        </a>
                    </li>
                @else
                    <li class="paginate_item page-item disabled">
                        <span class="paginate_button next page-link" aria-hidden="true">Next</span>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <!-- Pagination -->
@endif

