<div class="kalles-section nt_section type_tab type_tab_collection tp_se_cdt">
  <div class="fashion-nine__tab-wrap container mb__50">
    <div class="wrap_title des_title_8">
      <h3 class="section-title tc pr flex fl_center al_center fs__10 title_8">
        <span class="mr__10 ml__10 home_title">{{__('web/def.home_best_seller')}}</span>
      </h3>
      <span class="dn tt_divider"><span></span><i class="dn clprfalse title_8 la-gem"></i><span></span></span>
    </div>
    <div class="tab_se_wrap">
      <div class="tab_se_header tc">
        <ul class="tab_cat_title ul_none des_tab_10 mb__10">
          @foreach($homeCategory as $category)
            <li class="dib"><a class="js_t4_tab @if($loop->index == 0) tt_active @endif" data-bid="kalles-tab__{{$loop->index}}" href="#"><span>{{$category->name}}</span></a></li>
          @endforeach
        </ul>
      </div>
      <div class="tab_se_content">
        @foreach($homeCategory as $category)
          <div class="tab_se_element @if($loop->index == 0) ct_active @endif" id="kalles-tab__{{$loop->index}}">
            <div class="{{$proStyle['cardStyleHolder']}}">
              @foreach($category->products_home->take(8) as $product)
                <x-temp.products.card col="3" :quick-view="false" :product="$product"/>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<div class="kalles-section kalles-section_type_featured_blog nt_section type_featured_blog type_carousel bg-white">
  <div class="container mb__10">
    <div class="wrap_title mb__10 des_title_8">
      <h3 class="section-title tc pr flex fl_center al_center fs__24 title_8">
        <span class="mr__10 ml__10 home_title">{{__('web/def.home_brand')}}</span>
      </h3>
    </div>
    <div class="articles art_des1 nt_products_holder row nt_cover ratio4_3 position_8 equal_nt js_carousel nt_slider prev_next_1 btn_owl_1 dot_owl_1 dot_color_1 btn_vi_1"
         data-flickity="{&quot;imagesLoaded&quot;: 0,&quot;adaptiveHeight&quot;: 1, &quot;contain&quot;: 1, &quot;groupCells&quot;: &quot;100%&quot;, &quot;dragThreshold&quot; : 5, &quot;cellAlign&quot;: &quot;left&quot;,&quot;wrapAround&quot;: false,&quot;prevNextButtons&quot;: true,&quot;percentPosition&quot;: 1,&quot;pageDots&quot;: false, &quot;autoPlay&quot; : 0, &quot;pauseAutoPlayOnHover&quot; : true, &quot;rightToLeft&quot;: false }">
      @foreach($CashBrandMenuList->take(30) as $brand)
        <article class="post_nt_loop post_1 col-lg-2 col-md-2 col-6 mb__40">
          <a class="mb__20 db pr oh" href="{{route('BrandView',$brand->slug)}}">
            <div class="lazyload nt_bg_lz pr_lazy_img"
                 data-bgset="{{getPhotoPath($brand->photo_thum_1,"blog","photo")}}"></div>
          </a>
          <div class="post-info mb__5">
            <h4 class="mg__0 fs__16 mt__15 ls__0 text-center">
              <a class="cd chp open" href="{{route('BrandView',$brand->slug)}}">{{$brand->name}} ({{$brand->products_count}})</a>
            </h4>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</div>

<div class="kalles-section kalles-section_type_featured_blog nt_section type_featured_blog type_carousel bg-white">
  <div class="container mb__30">
    <div class="wrap_title mb__10 des_title_8">
      <h3 class="section-title tc pr flex fl_center al_center fs__24 title_8">
        <span class="mr__10 ml__10 home_title">{{__('web/def.home_latest_blog')}}</span>
      </h3>
    </div>
    <div class="articles art_des1 nt_products_holder row nt_cover ratio4_3 position_8 equal_nt js_carousel nt_slider prev_next_1 btn_owl_1 dot_owl_1 dot_color_1 btn_vi_1"
         data-flickity="{&quot;imagesLoaded&quot;: 0,&quot;adaptiveHeight&quot;: 1, &quot;contain&quot;: 1, &quot;groupCells&quot;: &quot;100%&quot;, &quot;dragThreshold&quot; : 5, &quot;cellAlign&quot;: &quot;left&quot;,&quot;wrapAround&quot;: false,&quot;prevNextButtons&quot;: true,&quot;percentPosition&quot;: 1,&quot;pageDots&quot;: false, &quot;autoPlay&quot; : 0, &quot;pauseAutoPlayOnHover&quot; : true, &quot;rightToLeft&quot;: false }">
      @foreach($latestBlog as $blog)
        <x-temp.blog.card col="4" :row="$blog"/>
      @endforeach
    </div>
  </div>
</div>