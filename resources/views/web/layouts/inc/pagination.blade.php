@if ($paginator->hasPages())
  <div class="products-footer tc">
    <nav class="nt-pagination w__100 tc paginate_ajax">
      <ul class="pagination-page page-numbers pagination_edit">
        @if ($paginator->onFirstPage())
          {{--                            <li class="disabled"><span>«</span></li>--}}
        @else
          <li class="page-item">
            <a href="{{ $paginator->previousPageUrl() }}" aria-label="previous" class="page-numbers" rel="prev">
              @if(app()->getLocale() == 'ar')
                <i class="las la-angle-double-right"></i>
              @else
                <i class="las la-angle-double-right"></i>
              @endif
            </a>
          </li>
        @endif

        @if($paginator->currentPage() > 2)
          <li class="hidden-xs"><a href="{{ $paginator->url(1) }}" aria-label="pagin" class="page-numbers">1</a></li>
        @endif
        @if($paginator->currentPage() > 3)
          {{--          <li class="page-item"><span class="page-numbers">...</span></li>--}}
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
          @if($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1)
            @if ($i == $paginator->currentPage())
              <li class="page-item"><span class="page-numbers current">{{ $i }}</span></li>
            @else
              <li class="page-item"><a href="{{ $paginator->url($i) }}" aria-label="pagin" class="page-numbers">{{ $i }}</a></li>
            @endif
          @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
          {{--          <li class="page-item"><span class="page-numbers">...</span></li>--}}
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 1)
          <li class="page-item hidden-xs"><a href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="lastPage"
                                             class="page-numbers">{{ $paginator->lastPage() }}</a></li>
        @endif


        @if ($paginator->hasMorePages())
          <li class="page-item">
            <a href="{{ $paginator->nextPageUrl() }}" aria-label="nextPageUrl" class="page-numbers" rel="next">
              @if(app()->getLocale() == 'ar')
                <i class="las la-angle-double-left"></i>
              @else
                <i class="las la-angle-double-left"></i>
              @endif
            </a>
          </li>
        @else

        @endif
      </ul>
    </nav>
  </div>



@endif
