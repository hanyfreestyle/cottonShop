<div id="quick-shop-tpl-{{$product->id}}" class="dn">
    <div class="wrap_qs_pr buy_qs_false kalles-quick-shop">
        <div class="qs_imgs_i row al_center mb__30">
            <div class="col-auto cl_pr_img">
                <div class="pr oh qs_imgs_wrap">
                    <div class="row equal_nt qs_imgs nt_slider nt_carousel_qs p-thumb_qs"
                         data-flickity="{&quot;fade&quot;:false,&quot;cellSelector&quot;:&quot;.qs_img_i&quot;,&quot;cellAlign&quot;:&quot;center&quot;,&quot;wrapAround&quot;:true,&quot;autoPlay&quot;:false,&quot;prevNextButtons&quot;:false,&quot;adaptiveHeight&quot;:true,&quot;imagesLoaded&quot;:false,&quot;lazyload&quot;:0,&quot;dragThreshold&quot;:0,&quot;pageDots&quot;:false,&quot;rightToLeft&quot;:false}">
                        <div class="col-12 js-sl-item qs_img_i nt_img_ratio lazyload nt_bg_lz"
                             data-bgset="{{getPhotoPath($product->photo_thum_1,"blog","photo")}}"></div>
                    </div>
                </div>
            </div>
            <div class="col cl_pr_title tc">
                <h3 class="product-title pr fs__16 mg__0 fwm">
                    <a class="cd chp" href="#">{{$product->name}}</a>
                </h3>
                <div id="price_qs">
                    {!! $proInfo['price'] !!}
                    <br>
                    {!! $proInfo['onsale'] !!}
                </div>
            </div>
        </div>
        <div class="qs_info_i tc">
            <div class="qs_swatch">
                <div id="callBackVariant_qs" class="nt_green nt1_xs nt2_">
                    <div id="cart-form_qs" class="nt_cart_form variations_form variations_form_qs">
                        <div class="variations mb__40 style__circle size_medium style_color des_color_1">
                            <div class="nt_select_qs1 swatch is-label kalles_swatch_js">
                                <h4 class="swatch__title">Size: <span class="nt_name_current">XS</span></h4>
                                <ul class="swatches-select swatch__list_pr">
                                    <li class="nt-swatch swatch_pr_item pr bg_css_xs is-selected" data-escape="XS">
                                        <span class="swatch__value_pr">XS</span>
                                    </li>
                                    <li class="nt-swatch swatch_pr_item pr " data-escape="S">
                                        <span class="swatch__value_pr">S</span>
                                    </li>
                                    <li class="nt-swatch swatch_pr_item pr " data-escape="M">
                                        <span class="swatch__value_pr">M</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="variations_button in_flex column w__100">
                            <div class="flex al_center column">
                                <div class="quantity pr mb__15 order-1 qty__" id="sp_qty_qs">
                                    <input type="number" class="input-text qty text tc qty_pr_js qty_cart_js" step="1" min="1" max="9999" name="quantity"
                                           value="1" inputmode="numeric">
                                    <div class="qty tc fs__14">
                                        <button type="button" class="plus db cb pa pd__0 pr__15 tr r__0">
                                            <i class="facl facl-plus"></i></button>
                                        <button type="button" class="minus db cb pa pd__0 pl__15 tl l__0">
                                            <i class="facl facl-minus"></i></button>
                                    </div>
                                </div>
                                <button type="submit" class="single_add_to_cart_button button truncate js_frm_cart w__100 order-4">
                                    <span class="txt_add ">{{__('web/product.but_add_to_cart')}}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{route('ProductView',$product->slug)}}" class="btn fwsb detail_link dib mt__15">{{__('web/product.but_view_full_details')}}</a>
        </div>
    </div>
</div>