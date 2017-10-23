<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
    <ul class="breadcrumbs">
        @foreach($crumbs as $crumbName => $crumbUrl)

            @if ($crumbUrl == '#')
                <li class="last"><span>{!! $crumbName !!}</span></li>
            @else
                <li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="{!! $crumbUrl !!}">{!! $crumbName !!}</a></li>
            @endif
        @endforeach
    </ul>
</div>