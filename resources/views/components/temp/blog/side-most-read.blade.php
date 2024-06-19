@if($isactive)
    @if(count($MostRead)>0 )
        <div class="col-12 col-md-12 widget widget_post_list  ">
            <h5 class="headline__title">{{__('web/blog.side_most_read')}}</h5>
            <div class="post_list_widget">
                @foreach($MostRead as $post)
                    <div class="row mb__10 pb__10">
                        <div class="col-auto widget_img_ar_new">
                            <a class="db pr oh" href="{{route('BlogView',$post->slug)}}"><img
                                 src="data:image/svg+xml,%3Csvg%20viewBox%3D%220%200%201920%201281%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3C%2Fsvg%3E"
                                 class="w__100 lz_op_ef lazyload" alt="{{$post->name}}"
                                 data-srcset="{{getPhotoPath($post->photo_thum_1,"blog_t","photo_thum_1")}}"></a>
                        </div>
                        <div class="col sidebar_info">
                            <a class="article-title db" href="{{route('BlogView',$post->slug)}}">{{$post->name}}</a>
                            <time>{{$post->getHomeFormatteDate()}}</time>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endif