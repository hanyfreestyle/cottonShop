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
            <div class="container mt-5">
                <textarea style="direction: ltr">{!! $printSchema->Product($product,"") !!}</textarea>
            </div>

      <div class="sp-single sp-single-1 des_pr_layout_1 mb__60">
        <div class="container container_cat cat_default  d-noneX">
          <div class="row product mt__10">
            <div class="col-md-12 col-12 thumb_left">
              <div class="row mb__10 pr_sticky_content this_product_view">
                <x-temp.products.product-slider :product="$product" :product-info="$productInfo"/>


                <div class="col-md-6 col-12 product-infors pr_sticky_su ">
                  <div class="theiaStickySidebar">
                    <div class="kalles-section-pr_summary kalles-section summary entry-summary">

                      <h1 class="headline__title">{{$product->name}}</h1>

                      <livewire:site.cart.add-to-cart-but :product="$product" :key="$product->id" :product-info="$productInfo"/>

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
