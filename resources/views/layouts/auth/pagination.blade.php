<div class="pagination-container" style="margin:0 auto">
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="paginate_button page-item previous disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="paginate_button page-item previous">
                <a href="{{ $paginator->previousPageUrl() }}" aria-controls="example2" tabindex="0"
                    class="page-link">Previous
                </a>
            </li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="paginate_button page-item disabled">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="paginate_button page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="paginate_button page-item">
                            <a href="{{ $url }}" aria-controls="example2" tabindex="0"
                                class="page-link">{{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li class="paginate_button page-item next"><a href="{{ $paginator->nextPageUrl() }}"
                    aria-controls="example2" tabindex="0" class="page-link">Next</a></li>
        @else
            <li class="paginate_button page-item next disabled"><span class="page-link">Next</span>
            </li>
        @endif
    </ul>
</div>
