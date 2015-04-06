@if ($paginator->getLastPage() > 1)
<nav class="text-center">
    <ul class="pagination">
        <li class="{{($paginator->getCurrentPage() == 1) ? ' disabled' : '' }}"><a href="{{ $paginator->getUrl($paginator->getCurrentPage()-1) }}" id="page[1]">Previous</a></li>
        @for ($i = 1; $i <= $paginator->getLastPage(); $i++)
        <li class="{{($paginator->getCurrentPage() == $i) ? ' active' : '' }}"><a href="{{ $paginator->getUrl($i) }}" id="page[{{$i}}]">{{ $i }}</a></li>
        @endfor
        <li class="{{($paginator->getCurrentPage() == $paginator->getLastPage()) ? ' disabled' : '' }}"><a href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}" id="page[{{$paginator->getCurrentPage()+1}}]">Next</a></li>

    </ul>
</nav>
@endif