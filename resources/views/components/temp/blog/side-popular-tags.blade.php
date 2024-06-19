@if($isactive)
    <div class="col-12 col-md-12 widget widget_text">
        <h5 class="headline__title">{{__('web/blog.side_blog_tags')}}</h5>
        <div class="loke_scroll">
            <ul class="nt_filter_block nt_filter_styletag blg_count_true">
                @foreach($popularTags as $tag)
                    <li><a href="{{route('BlogTagView',$tag->slug)}}">{{$tag->name}}<span class="blg_count"> ({{$tag->blogs_count}})</span></a></li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
