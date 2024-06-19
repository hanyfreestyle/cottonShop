@if(count($row->tags)>0)
    <div class="tag-comment mt__40">
        <div class="row al_center">
            <div class="post-tags col-12 col-md tc tl_md">
                <i class="facl facl-tags"></i>
                @foreach($row->tags as  $tag )
                    <a href="{{route('BlogTagView',$tag->slug)}}">#{{$tag->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
@endif
