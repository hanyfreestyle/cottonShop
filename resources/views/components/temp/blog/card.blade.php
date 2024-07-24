<article class="post_nt_loop post_1 {{$col}} mb__20">
    <a class="mb__10 db pr oh" href="{{route('BlogView',$row->slug)}}">
        <div class="lazyload nt_bg_lz pr_lazy_img" data-alt="{{$row->name}}" data-bgset="{{getPhotoPath($row->photo_thum_1,"blog_t","photo")}}"></div>
    </a>
    <div class="post-info mb__5">
                    <span class="post-author mr__5">{{__('web/blog.post_by')}}
                      <span class="cd blog_author_name"><a href="{{ route('BlogAuthorView',$row->user->slug)}}">{{$row->user->name}}</a></span></span>
        <span class="post-time"> {{__('web/blog.post_on')}} <span class="cd"><time> {{$row->getHomeFormatteDate()}}</time></span></span>
        <h4 class="mg__0 fs__16 mt__5 ls__0">
            <a class="cd chp open" href="{{route('BlogView',$row->slug)}}">{{$row->name}}</a>
        </h4>
        <p class="mt__10">{{\App\Helpers\AdminHelper::seoDesClean($row->des,200)}}</p>
    </div>
</article>
{!! $printSchema->Article($row,'BlogView') !!}
{{--<div class="container mt-5">--}}
{{--    <textarea style="direction: ltr">{!! $printSchema->Article($row,'BlogView') !!}</textarea>--}}
{{--</div>--}}

