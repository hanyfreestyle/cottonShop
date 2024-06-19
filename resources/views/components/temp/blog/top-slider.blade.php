<div class="kalles-section nt_section type_carousel">
  <div class="nt_se_blog-slider nt_full">
    <div
     class="articles row no-gutters nt_cover ratio4_3 position_8 equal_nt js_carousel nt_slider prev_next_0 btn_owl_1 dot_owl_1 dot_color_1 btn_vi_1"
     data-flickity="{&quot;imagesLoaded&quot;: 0,&quot;adaptiveHeight&quot;: 1, &quot;contain&quot;: 1, &quot;groupCells&quot;: &quot;100%&quot;, &quot;dragThreshold&quot; : 5, &quot;cellAlign&quot;: &quot;left&quot;,&quot;wrapAround&quot;: false,&quot;prevNextButtons&quot;: true,&quot;percentPosition&quot;: 1,&quot;pageDots&quot;: false, &quot;autoPlay&quot; : 0, &quot;pauseAutoPlayOnHover&quot; : true, &quot;rightToLeft&quot;: false }">
      @foreach($row as $post)
        <article class="post_nt_loop post_2 post-thumbnail pr oh col-lg-4 col-md-4 col-12">
          <a class="db oh bgd" href="{{route('BlogView',$post->slug)}}">
            <div class="lazyload nt_bg_lz pr_lazy_img" data-alt="{{$post->name}}" data-bgset="{{getPhotoPath($post->photo_thum_1,"blog","photo")}}"></div>
          </a>
          <div class="pa tc cg w__100 z_100">
            <h2 class="post-title fs__14 mt__10 mb__5 tu">
              <a class="chp crop_line_1" href="{{route('BlogView',$post->slug)}}">{{$post->name}} {{$post->name}}</a>
            </h2>
            <span class="post-time cg"><time class="entry-date">{{$post->getHomeFormatteDate()}}</time></span>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</div>