<div class="btn_sidebar ">
  <a href="#" data-opennt="#kalles-section-sidebar_shop" data-pos="right" data-remove="true" data-class="popup_filter" data-bg="hide_btn"
     class="has_icon btn_sidebar mgr op__0"><i class="iccl fwb iccl-trello fwb mr__5"></i></a>
</div>

<div id="kalles-section-sidebar_shop" class="kalles-section nt_ajaxFilter section_sidebar_shop type_instagram">
  <div class="h3 mg__0 tu bgb cw visible-sm fs__16 pr">{{__('web/sidebar.title')}}<i class="close_pp pegk pe-7s-close fs__40 ml__5"></i></div>
  <div class="cat_shop_wrap">
    <div class="cat_fixcl-scroll">
      <div class="cat_fixcl-scroll-content css_ntbar">
        <div class="row no-gutters wrap_filter">


          @if(count($subCat) > 0 )
            <div class="col-12 col-md-12 widget widget_product_categories cat_count_falseX">
              <h5 class="headline__title">{{__('web/sidebar.h5_category_sub')}}</h5>
              <ul class="product-categories mt__10">
                @foreach($subCat as $category)
                  <li class="cat-item"><a href="{{route('ProductsCategoriesView',$category->slug)}}">{{$category->name}}
                      <span class="cat_count">({{$category->products_count}})</span></a></li>
                @endforeach
              </ul>
            </div>
          @endif


          @if($categoryView == true)
            <div class="col-12 col-md-12 widget widget_product_categories cat_count_falseX">
              <h5 class="headline__title">{{__('web/sidebar.h5_category')}}</h5>
              <ul class="product-categories mt__10">
                @foreach($CashCategoryMenuList->take($categoryLimit) as $category)
                  <li class="cat-item"><a href="{{route('ProductsCategoriesView',$category->slug)}}">{{$category->name}}
                      <span class="cat_count">({{$category->products_count}})</span></a></li>
                @endforeach
                @if(count($CashCategoryMenuList) > $categoryLimit)
                  <li class="cat-item readmore"><a href="{{route('ProductsCategoriesList')}}">{{__('web/def.but_show_more')}}</a></li>
                @endif
              </ul>
            </div>
          @endif

          @if($brandView == true)
            <div class="col-12 col-md-12 widget widget_product_categories cat_count_falseX">
              <h5 class="headline__title">{{__('web/sidebar.h5_brand')}}</h5>
              <ul class="product-categories mt__10">
                @foreach($CashBrandMenuList->take($brandLimit) as $brand)
                  @if($brand->products_count > 1)
                    <li class="cat-item"><a href="{{route('BrandView',$brand->slug)}}">{{$brand->name}}
                        <span class="cat_count">({{$brand->products_count}})</span></a></li>
                  @endif
                @endforeach
                @if(count($CashBrandMenuList) > $brandLimit)
                  <li class="cat-item readmore"><a href="{{route('BrandList')}}">{{__('web/def.but_show_more')}}</a></li>
                @endif
              </ul>
            </div>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>