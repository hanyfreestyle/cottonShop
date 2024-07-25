@extends('web.layouts.app')
@section('content')
    <div id="nt_content" class="mt__5">
        <x-site.def.breadcrumbs>
            {{ Breadcrumbs::render('Offers',$meta) }}
        </x-site.def.breadcrumbs>

        <x-site.def.h-title :title="$meta->name" :p="$meta->des"/>

        <div class="container container_cat cat_default mt__40 mb__20">
            <div class="row nt_single_blog">

                <div class="col-lg-12 order-lg-12 order-1 col-xs-12">
                    <div class="kalles-section nt_section type_isotope">
                        <div class="articles products art_des2 nt_products_holder row des_cnt_1 nt_cover ratio4_3 position_8 equal_nt">
                            @foreach($offers as $offer)

                                <article class="post_nt_loop post_1 col-lg-3 col-md-3 col-6 mb__40">
                                    <a class="mb__20 db pr oh" href="{{route('page_OffersView',$offer->slug)}}">
                                        @if($offer->photo_thum_1)
                                            <div class="lazyload nt_bg_lz pr_lazy_img" data-bgset="{{getPhotoPath($offer->photo_thum_1,"brand","photo")}}"></div>
                                        @else
                                            @if($offer->barnd->photo_thum_1 ?? null)
                                                <div class="lazyload nt_bg_lz pr_lazy_img"
                                                     data-bgset="{{getPhotoPath($offer->barnd->photo_thum_1,"brand","photo")}}"></div>
                                            @else
                                                <div class="lazyload nt_bg_lz pr_lazy_img" data-bgset="{{getPhotoPath($offer->photo_thum_1,"brand","photo")}}"></div>
                                            @endif
                                        @endif
                                    </a>
                                    <div class="post-info mb__5">
                                        <h4 class="mg__0 fs__16 mt__15 ls__0 text-center">
                                            <a class="cd chp open" href="{{route('page_OffersView',$offer->slug)}}">{{$offer->name}} ({{ count($offer->product_id) }})</a>
                                        </h4>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        <x-site.def.pagination :rows="$offers"/>
                    </div>
                </div>

            </div>
        </div>
        <x-temp.footer-icon/>

    </div>
@endsection
