@extends('web.layouts.app')
@section('content')
  <div id="nt_content" class="mt__5">

    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('BrandList',$meta) }}
    </x-site.def.breadcrumbs>

    <x-site.def.h-title :title="$meta->name" :p="$meta->des"/>


    <div class="container container_cat cat_default mt__40 mb__20">
      <div class="row nt_single_blog">

        <div class="col-lg-12 order-lg-12 order-1 col-xs-12">
          <div class="kalles-section nt_section type_isotope">
            <div class="articles products art_des2 nt_products_holder row des_cnt_1 nt_cover ratio4_3 position_8 equal_nt">
              @foreach($brands as $brand)
                <article class="post_nt_loop post_1 col-lg-3 col-md-3 col-6 mb__40">
                  <a class="mb__20 db pr oh" href="{{route('BrandView',$brand->slug)}}">
                    <div class="lazyload nt_bg_lz pr_lazy_img"
                         data-bgset="{{getPhotoPath($brand->photo_thum_1,"brand","photo")}}"></div>
                  </a>
                  <div class="post-info mb__5">
                    <h4 class="mg__0 fs__16 mt__15 ls__0 text-center">
                      <a class="cd chp open" href="{{route('BrandView',$brand->slug)}}">{{$brand->name}} ({{$brand->products_count}})</a>
                    </h4>
                  </div>
                </article>
              @endforeach
            </div>
            <x-site.def.pagination :rows="$brands"/>
          </div>
        </div>

      </div>
    </div>

    <x-temp.footer-icon/>
  </div>


@endsection
