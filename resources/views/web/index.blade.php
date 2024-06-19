@extends('web.layouts.app')
@section('content')
  <div id="nt_content" class="mt__20 mb__30">

    <div class="kalles-section nt_section type_carousel type_collection_list">
      <div class="kalles-electronic-vertical__cat-banner container">
        <div class="mt__40 mb__30 nt_cats_holder row fl_center equal_nt hoverz_true ratio_cus1 cat_space_10 cat_design_1">
          @foreach($CashCategoryMenuList->take(6) as $category)
            <div class="cat_grid_item cat_space_item cat_grid_item_1 col-lg-4 col-md-4 col-12">
              <div class="cat_grid_item__content pr oh">
                <a href="{{route('ProductsCategoriesView',$category->slug)}}" class="db cat_grid_item__link">
                  <div class="cat_grid_item__overlay item__position nt_bg_lz lazyload center" data-bgset="{{getPhotoPath($category->photo_thum_1,"categories","photo")}}"></div>
                </a>
                <div class="cat_grid_item__wrapper pe_none">
                  <div class="cat_grid_item__title">{{$category->name}}</div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="kalles-section nt_section type_tab type_tab_collection tp_se_cdt">
      <div class="fashion-nine__tab-wrap container mb__50">
        <h3 class="headline__title">{{__('web/def.home_best_seller')}}</h3>
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
        <h3 class="headline__title">{{__('web/def.home_brand')}}</h3>
        <div class="articles art_des1 nt_products_holder row nt_cover ratio4_3 position_8 equal_nt js_carousel nt_slider prev_next_1 btn_owl_1 dot_owl_1 dot_color_1 btn_vi_1"
             data-flickity="{&quot;imagesLoaded&quot;: 0,&quot;adaptiveHeight&quot;: 1, &quot;contain&quot;: 1, &quot;groupCells&quot;: &quot;100%&quot;, &quot;dragThreshold&quot; : 5, &quot;cellAlign&quot;: &quot;left&quot;,&quot;wrapAround&quot;: false,&quot;prevNextButtons&quot;: true,&quot;percentPosition&quot;: 1,&quot;pageDots&quot;: false, &quot;autoPlay&quot; : 0, &quot;pauseAutoPlayOnHover&quot; : true, &quot;rightToLeft&quot;: false }">
          @foreach($CashBrandMenuList->take(30) as $brand)
            <article class="post_nt_loop post_1 col-lg-2 col-md-2 col-6 mb__40">
              <a class="mb__20 db pr oh" href="{{route('BrandView',$brand->slug)}}">
                <div class="lazyload nt_bg_lz pr_lazy_img" data-bgset="{{getPhotoPath($brand->photo_thum_1,"brand","photo")}}"></div>
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
        <h3 class="headline__title">{{__('web/def.home_latest_blog')}}</h3>

        <div class="articles art_des1 nt_products_holder row nt_cover ratio4_3 position_8 equal_nt js_carousel nt_slider prev_next_1 btn_owl_1 dot_owl_1 dot_color_1 btn_vi_1"
             data-flickity="{&quot;imagesLoaded&quot;: 0,&quot;adaptiveHeight&quot;: 1, &quot;contain&quot;: 1, &quot;groupCells&quot;: &quot;100%&quot;, &quot;dragThreshold&quot; : 5, &quot;cellAlign&quot;: &quot;left&quot;,&quot;wrapAround&quot;: false,&quot;prevNextButtons&quot;: true,&quot;percentPosition&quot;: 1,&quot;pageDots&quot;: false, &quot;autoPlay&quot; : 0, &quot;pauseAutoPlayOnHover&quot; : true, &quot;rightToLeft&quot;: false }">
          @foreach($latestBlog as $blog)
            <x-temp.blog.card col="4" :row="$blog"/>
          @endforeach
        </div>
      </div>
    </div>

  </div>

  <x-temp.footer-icon/>
@endsection
