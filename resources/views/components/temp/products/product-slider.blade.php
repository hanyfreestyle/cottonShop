@if($thumb == true)
    <div class="col-md-6 col-12 mb__30 pr product-images {{$zoom}} pr_sticky_img kalles_product_thumnb_slide">
        <div class="row theiaStickySidebar">
            <div class="col-12 col-lg col_thumb">

                <div class="p-thumb p-thumb_ppr images sp-pr-gallery equal_nt nt_contain ratio_imgtrue position_8 nt_slider pr_carousel"
                     data-flickity="{&quot;initialIndex&quot;: &quot;.media_id_001&quot;,&quot;fade&quot;:true,&quot;draggable&quot;:&quot;>1&quot;,&quot;cellAlign&quot;: &quot;center&quot;,&quot;wrapAround&quot;: true,&quot;autoPlay&quot;: false,&quot;prevNextButtons&quot;:true,&quot;adaptiveHeight&quot;: true,&quot;imagesLoaded&quot;: false, &quot;lazyLoad&quot;: 0,&quot;dragThreshold&quot; : 6,&quot;pageDots&quot;: false,&quot;rightToLeft&quot;: false }">
                    {{--          img_ptw p_ptw p-item sp-pr-gallery__img w__100 nt_bg_lz lazyload padding-top__127_66 media_id_001--}}
                    <div class="img_ptw p_ptw p-item sp-pr-gallery__img w__100 nt_bg_lz lazyload padding-top__127_66 media_id_001" data-mdid="{{$product->id}}" data-height="1440"
                         data-width="1128" data-ratio="0.7833333333333333" data-mdtype="image" data-src="{{getPhotoPath($product->photo,"product","photo")}}"
                         data-bgset="{{getPhotoPath($product->photo,"product","photo")}}" data-cap="{{$product->name}}"></div>
                    @if($product->more_photos_count > 0)
                        @foreach($product->more_photos as $photo)
                            <div class="img_ptw p_ptw p-item sp-pr-gallery__img w__100 nt_bg_lz lazyload padding-top__127_66 media_id_001" data-mdid="{{$product->id}}-{{$photo->id}}" data-height="1440"
                                 data-width="1128" data-ratio="0.7833333333333333" data-mdtype="image" data-src="{{getPhotoPath($photo->photo,"product","photo")}}"
                                 data-bgset="{{getPhotoPath($photo->photo,"product","photo")}}" data-cap="{{$product->name}}"></div>
                        @endforeach
                    @endif

                </div>
                <span class="tc nt_labels pa pe_none cw"><span class="onsale nt_label"><span>-40%</span></span></span>

                @if($product->more_photos_count > 0 and $photoPswp)
                    <div class="p_group_btns pa flex">
                        <button class="br__40 tc flex al_center fl_center bghp show_btn_pr_gallery ttip_nt tooltip_top_left">
                            <i class="las la-expand-arrows-alt"></i><span class="tt_txt">{{__('web/product.but_zoom')}}</span>
                        </button>
                    </div>
                @endif
            </div>
            @if($product->more_photos_count > 0)
                <div class="col-12 col-lg-auto col_nav nav_medium t4_show">
                    <div class="p-nav ratio_imgtrue row equal_nt nt_cover position_8 nt_slider pr_carousel"
                         data-flickityjs="{&quot;initialIndex&quot;: &quot;.media_id_001&quot;,&quot;cellSelector&quot;: &quot;.n-item:not(.is_varhide)&quot;,&quot;cellAlign&quot;: &quot;left&quot;,&quot;asNavFor&quot;: &quot;.p-thumb&quot;,&quot;wrapAround&quot;: true,&quot;draggable&quot;: &quot;>1&quot;,&quot;autoPlay&quot;: 0,&quot;prevNextButtons&quot;: 0,&quot;percentPosition&quot;: 1,&quot;imagesLoaded&quot;: 0,&quot;pageDots&quot;: 0,&quot;groupCells&quot;: 3,&quot;rightToLeft&quot;: false,&quot;contain&quot;:  1,&quot;freeScroll&quot;: 0}"></div>
                    <button type="button" aria-label="Previous" class="btn_pnav_prev pe_none">
                        <i class="las la-angle-up"></i>
                    </button>
                    <button type="button" aria-label="Next" class="btn_pnav_next pe_none">
                        <i class="las la-angle-down"></i>
                    </button>
                </div>
            @endif


            @if($zoom != null)
                <div class="dt_img_zoom pa t__0 r__0 dib"></div>
            @endif

        </div>
    </div>
@else
    <div class="col-md-6 col-12 mb__30 pr product-images {{$zoom}} pr_sticky_img">
        <div class="row theiaStickySidebar">
            <div class="col-12">
                <div class="p-thumb p-thumb_ppr images sp-pr-gallery equal_nt nt_contain ratio_imgtrue position_8 nt_slider pr_carousel"
                     data-flickity="{&quot;initialIndex&quot;: &quot;.media_id_001&quot;,&quot;fade&quot;:true,&quot;draggable&quot;:&quot;>1&quot;,&quot;cellSelector&quot;: &quot;.p-item:not(.is_varhide)&quot;,&quot;cellAlign&quot;: &quot;center&quot;,&quot;wrapAround&quot;: true,&quot;autoPlay&quot;: false,&quot;prevNextButtons&quot;:true,&quot;adaptiveHeight&quot;: true,&quot;imagesLoaded&quot;: false, &quot;lazyLoad&quot;: 0,&quot;dragThreshold&quot; : 6,&quot;pageDots&quot;: false,&quot;rightToLeft&quot;: false }">

                    <div data-grname="not4" data-grpvl="ntt4" data-mdid="{{$product->id}}"
                         class="img_ptw p_ptw js-sl-item p-item sp-pr-gallery__img w__100 nt_bg_lz media_id_001 lazyload padding-top__127_66" data-mdtype="image"
                         data-bgset="{{getPhotoPath($product->photo,"product","photo")}}" data-src="{{getPhotoPath($product->photo,"product","photo")}}"
                         data-width="1128" data-height="1440" data-ratio="0.7833333333333333" data-sizes="auto" data-cap="{{$product->name}}">
                        <img class="op_0 dn" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="{{$product->name}}">
                    </div>

                    @if($product->more_photos_count > 0)
                        @foreach($product->more_photos as $photo)
                            <div data-grname="not4" data-grpvl="ntt4" data-mdid="{{$product->id}}-{{$photo->id}}"
                                 class="img_ptw p_ptw js-sl-item p-item sp-pr-gallery__img w__100 nt_bg_lz media_id_001 lazyload padding-top__127_66" data-mdtype="image"
                                 data-bgset="{{getPhotoPath($photo->photo,"product","photo")}}" data-src="{{getPhotoPath($photo->photo,"product","photo")}}"
                                 data-width="1128" data-height="1440" data-ratio="0.7833333333333333" data-sizes="auto" data-cap="{{$product->name}}">
                                <img class="op_0 dn" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="{{$product->name}}">
                            </div>
                        @endforeach
                    @endif
                </div>
                {!! $productInfo['onsale'] !!}
                @if($product->more_photos_count > 0 and $photoPswp)
                    <div class="p_group_btns pa flex">
                        <button class="br__40 tc flex al_center fl_center bghp show_btn_pr_gallery ttip_nt tooltip_top_left">
                            <i class="las la-expand-arrows-alt"></i><span class="tt_txt">{{__('web/product.but_zoom')}}</span>
                        </button>
                    </div>
                @endif
            </div>
            @if($zoom != null)
                <div class="dt_img_zoom pa t__0 r__0 dib"></div>
            @endif
        </div>
    </div>
@endif