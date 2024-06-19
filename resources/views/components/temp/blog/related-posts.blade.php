<div class="container mb__50">
  <div class="row nt_single_blog">
    <div class="col-md-12 col-xs-12">
      <div id="kalles-section-article-template" class="kalles-section type_carousel">
        <div class="post-related mt__50">
          <h3 class="headline__title">{{__('web/blog.blog_related_blog')}}</h3>
          <div class="nt_slider row nt_cover ratio4_3 position_8 equal_nt js_carousel nt_slider prev_next_0 btn_owl_1 dot_owl_1 dot_color_1 btn_vi_2"
               data-flickity="{&quot;imagesLoaded&quot;: 0,&quot;adaptiveHeight&quot;: 1, &quot;contain&quot;: 1, &quot;groupCells&quot;: &quot;100%&quot;, &quot;dragThreshold&quot; : 5, &quot;cellAlign&quot;: &quot;left&quot;,&quot;wrapAround&quot;: false,&quot;prevNextButtons&quot;: true,&quot;percentPosition&quot;: 1,&quot;pageDots&quot;: false, &quot;autoPlay&quot; : 0, &quot;pauseAutoPlayOnHover&quot; : true, &quot;rightToLeft&quot;: false }">
            @foreach($row as $post)
              <div class="item col-lg-3 col-md-3 col-12 pr_animated_done">
                <a class="db mb__20 lazyload nt_bg_lz pr_lazy_img" data-alt="{{$post->name}}" href="{{route('BlogView',$post->slug)}}"
                   data-bgset="{{getPhotoPath($post->photo_thum_1,"blog","photo")}}"></a>
                <h5 class="mg__0 fs__14 mb__5 d-block">
                  <a class="cd chp" href="{{route('BlogView',$post->slug)}}">{{$post->name}}</a>
                </h5>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


