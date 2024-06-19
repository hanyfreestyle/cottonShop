<div id="quick-view-tpl-{{$product->id}}" class="dn">
  <div class="product-quickview this_is_quick_view single-product-content img_action_zoom kalles-quick-view-tpl">
    <div class="row product-image-summary">
      <div class="col-lg-7 col-md-6 col-12 product-imagesX pr oh">
        {!! $proInfo['onsale'] !!}
        <div class="images">
          <div class="product-images-slider tc equal_nt nt_slider nt_carousel_qv p-thumb_qv nt_contain ratio_imgtrue position_8"
               data-flickity="{ &quot;fade&quot;:true,&quot;cellSelector&quot;: &quot;.q-item:not(.is_varhide)&quot;,&quot;cellAlign&quot;: &quot;center&quot;,&quot;wrapAround&quot;: true,&quot;autoPlay&quot;: false,&quot;prevNextButtons&quot;:true,&quot;adaptiveHeight&quot;: true,&quot;imagesLoaded&quot;: false, &quot;lazyLoad&quot;: 0,&quot;dragThreshold&quot; : 0,&quot;pageDots&quot;: true,&quot;rightToLeft&quot;: false }">
            <div data-grname="not4" data-grpvl="ntt4" class="js-sl-item q-item sp-pr-gallery__img w__100" data-mdtype="image">
              <span class="nt_bg_lz lazyload" data-bgset="{{getPhotoPath($product->photo,"product","photo")}}"></span>
            </div>
            @if(count($product->more_photos) > 0)
              @foreach($product->more_photos as $photo)
                <div data-grname="not4" data-grpvl="ntt4" class="js-sl-item q-item sp-pr-gallery__img w__100" data-mdtype="image">
                  <span class="nt_bg_lz lazyload" data-bgset="{{getPhotoPath($photo->photo,"product","photo")}}"></span>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-5 col-md-6 col-12 summary entry-summary pr">
        <div class="summary-inner gecko-scroll-quick">
          <div class="gecko-scroll-content-quick">
            <div class="kalles-section-pr_summary kalles-section summary entry-summary mt__30">
              <h1 class="product_title entry-title fs__16"><a href="#">{{$product->name}}</a></h1>
              <div class="flex wrap fl_between al_center price_quick_view">
                {!! $proInfo['price'] !!}
              </div>

              <div class="pr_short_des">
                <p class="mg__0">{!! $proInfo['short_des'] !!}</p>
              </div>


              @if($addToCart)
                <div class="btn-atc atc-slide btn_des_1 btn_txt_3">
                  <div id="callBackVariant_qv" class="nt_pink nt1_ nt2_">
                    <div id="cart-form_qv" class="nt_cart_form variations_form variations_form_qv">

                      <div class="variations mb__40 style__circle size_medium style_color des_color_1">
                        <div class="swatch is-label kalles_swatch_js">
                          <h4 class="swatch__title">Size:<span class="nt_name_current user_choose_js">M</span></h4>
                          <ul class="swatches-select swatch__list_pr">
                            <li class="nt-swatch swatch_pr_item pr" data-escape="XS"><span class="swatch__value_pr">XS</span></li>
                            <li class="nt-swatch swatch_pr_item pr" data-escape="S"><span class="swatch__value_pr">S</span></li>
                            <li class="nt-swatch swatch_pr_item pr is-selected" data-escape="M"><span class="swatch__value_pr">M</span></li>
                          </ul>
                        </div>
                      </div>


                      <div class="variations_button in_flex column w__100 buy_qv_false">
                        <div class="flex wrap">
                          <div class="quantity pr mr__10 order-1 qty__true" id="sp_qty_qv">
                            <input type="number" class="input-text qty text tc qty_pr_js qty_cart_js" value="1" name="quantity" inputmode="numeric">
                            <div class="qty tc fs__14">
                              <button type="button" class="plus db cb pa pd__0 pr__15 tr r__0"><i class="facl facl-plus"></i></button>
                              <button type="button" class="minus db cb pa pd__0 pl__15 tl l__0"><i class="facl facl-minus"></i></button>
                            </div>
                          </div>
                          <button type="submit" data-time="6000" data-ani="shake" class="single_add_to_cart_button button truncate js_frm_cart w__100 mt__20 order-4">
                            <span class="txt_add ">{{__('web/product.but_add_to_cart')}}</span>
                          </button>
                          <livewire:site.favorite-icon :product="$product"/>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              @endif

              <x-temp.products.product-meta :product="$product" />

              <x-temp.social-share :row="$product" share-type="QuickPro"/>

              <div class="text-center">
                <a href="{{route('ProductView',$product->slug)}}" class="btn fwsb detail_link p-0 fs__14">{{__('web/product.but_view_full_details')}}</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>