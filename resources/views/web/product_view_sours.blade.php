@extends('web.layouts.app')
@section('AddStyle')
  {!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/single-masonry-theme.css',$cssMinifyType,$cssReBuild) !!}
  {!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/single-product.css',$cssMinifyType,$cssReBuild) !!}
@endsection
@section('TempScript')
  {!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/photoswipe.min.js',"Web",false) !!}
  {!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/photoswipe-ui-default.min.js',"Web",false) !!}
  {!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/drift.min.js',"Web",false) !!}
  {!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/isotope.pkgd.min.js',"Web",false) !!}
  {!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/resize-sensor.min.js',"Web",false) !!}
  {!! (new \App\Helpers\MinifyTools)->MinifyJs('temp/js/theia-sticky-sidebar.min.js',"Web",false) !!}
@endsection
@section('content')
  <div id="nt_wrapper">
    <div id="nt_content mt__10">
      <x-site.def.breadcrumbs>
        {{ Breadcrumbs::render('ProductView',$product) }}
      </x-site.def.breadcrumbs>
      <div class="sp-single sp-single-1 des_pr_layout_1 mb__60">
        <div class="container container_cat cat_default  d-noneX">
          <div class="row product mt__40">
            <div class="col-md-12 col-12 thumb_left">
              <div class="row mb__10 pr_sticky_content this_product_view">
                <x-temp.products.product-slider :product="$product" :product-info="$productInfo"  />


                <div class="col-md-6 col-12 product-infors pr_sticky_su ">
                  <div class="theiaStickySidebar">
                    <div class="kalles-section-pr_summary kalles-section summary entry-summary">

                      <h1 class="product_title entry-title fs__16">{{$product->name}}</h1>

                      <div class="product_info">
                        {!! $productInfo['price'] !!}
                      </div>
                      <div class="pr_short_des">
                        <p class="mg__0"> {!! $productInfo['short_des'] !!}</p>
                      </div>

        
                      <div class="btn-atc atc-slide btn_des_1 btn_txt_3">
                        <div id="callBackVariant_ppr">

{{--                          <div class="variations mb__40 style__circle size_medium style_color des_color_1">--}}
{{--                            <div class="swatch is-label kalles_swatch_js">--}}
{{--                              <h4 class="swatch__title">Size:--}}
{{--                                <span class="nt_name_current user_choose_js">M</span>--}}
{{--                              </h4>--}}
{{--                              <ul class="swatches-select swatch__list_pr d-flex">--}}
{{--                                <li class="nt-swatch swatch_pr_item pr is-selected" data-escape="S">--}}
{{--                                  <span class="swatch__value_pr">S</span>--}}
{{--                                </li>--}}
{{--                                <li class="nt-swatch swatch_pr_item pr" data-escape="M">--}}
{{--                                  <span class="swatch__value_pr">M</span>--}}
{{--                                </li>--}}
{{--                                <li class="nt-swatch swatch_pr_item pr " data-escape="L">--}}
{{--                                  <span class="swatch__value_pr">L</span>--}}
{{--                                </li>--}}
{{--                              </ul>--}}
{{--                            </div>--}}
{{--                          </div>--}}

                          <div class="nt_cart_form variations_form variations_form_ppr  d-none">
                            <div class="variations_button in_flex column w__100 buy_qv_false">
                              <div class="flex wrap">
                                <div class="quantity pr mr__10 order-1 qty__true d-inline-block" id="sp_qty_ppr">
                                  <input type="number" class="input-text qty text tc qty_pr_js qty_cart_js" name="quantity" value="1">
                                  <div class="qty tc fs__14">
                                    <button type="button" class="plus db cb pa pd__0 pr__15 tr r__0">
                                      <i class="facl facl-plus"></i>
                                    </button>
                                    <button type="button" class="minus db cb pa pd__0 pl__15 tl l__0">
                                      <i class="facl facl-minus"></i>
                                    </button>

                                  </div>
                                </div>



                                <button type="submit" data-time="6000" data-ani="shake"
                                        class="single_add_to_cart_button button truncate w__100 mt__20 order-4 d-inline-block animated">
                                  <span class="txt_add ">Add to cart</span>
                                </button>

                                <livewire:site.favorite-icon fromwhere="ViewPro" :product="$product" :key="$product->id"/>

                              </div>
                            </div>
                          </div>

                        </div>
                      </div>

                      <x-temp.products.product-meta :product="$product"/>

                      <x-temp.social-share :row="$product"/>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <x-temp.products.description-tab :product="$product"/>
        <div class="clearfix"></div>
        <x-temp.products.recently-slider :products="$related" :title="__('web/product.slider_related_product')"/>
        <x-temp.products.recently-slider :products="$recently" :title="__('web/product.slider_recently')"/>
      </div>
    </div>
  </div>
@endsection
