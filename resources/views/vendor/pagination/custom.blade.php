<style>
    .pagination {
        gap: 5px;
    }

    .pagination .page-link {
        border: none;
        background: #f1f1f1;
        color: #555;
        border-radius: 6px;
        min-width: 36px;
        text-align: center;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: #fff;
    }

    .pagination .page-item.disabled .page-link {
        background-color: #e9ecef;
        color: #aaa;
    }
</style>

@if ($paginator->hasPages())

    <div class="clearfix filters-container">
        <div class="text-right">
            <div class="pagination-container">

                <ul class="pagination justify-content-end">

                    {{-- Previous --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled">
                        <span class="page-link">
                            <i class="fa fa-angle-left"></i>
                        </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Pages --}}
                    @foreach ($elements as $element)

                        {{-- ... --}}
                        @if (is_string($element))
                            <li class="page-item disabled">
                                <span class="page-link">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Numbers --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active">
                                    <span class="page-link">
                                        {{ $page }}
                                    </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif

                    @endforeach

                    {{-- Next --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                        <span class="page-link">
                            <i class="fa fa-angle-right"></i>
                        </span>
                        </li>
                    @endif

                </ul>

            </div>
        </div>
    </div>

@endif
