<div id="wrap_des_pr">
    <div class="container container_des">
        <div class="kalles-section-pr_description kalles-section kalles-tabs sp-tabs nt_section">
            <ul class="ul_none ul_tabs is-flex fl_center fs__16 des_mb_2 des_style_1">
                <li class="tab_title_block active"><a class="db cg truncate pr" href="#tab_product_description">{!! __('web/product.tab_description') !!}</a></li>
                @if(count($product->attributes) > 0)
                    <li class="tab_title_block"><a class="db cg truncate pr" href="#tab_additional_information">{!! __('web/product.tab_additional_information') !!}</a>
                    </li>
                @endif
                @if(issetArr($WebConfig,"pro_warranty_tab",1))
                    <li class="tab_title_block"><a class="db cg truncate pr" href="#tab_warranty_and_shipping">{!! __('web/product.tab_warranty') !!}</a></li>
                @endif
                @if(issetArr($WebConfig,"pro_shipping_tab",1))
                    <li class="tab_title_block"><a class="db cg truncate pr" href="#tab_wash_and_care">{!! __('web/product.tab_shipping') !!}</a></li>
                @endif
            </ul>
            <div class="panel entry-content sp-tab des_mb_2 des_style_1 active" id="tab_product_description">
                <div class="js_ck_view"></div>
                <div class="heading bgbl dn">
                    <a class="tab-heading flex al_center fl_between pr cd chp fwm" href="#tab_product_description"><span
                            class="txt_h_tab">{!! __('web/product.tab_description') !!}</span><span
                            class="nav_link_icon ml__5"></span></a>
                </div>
                <div class="sp-tab-content BrandDesView">
                    {!! cleanDes($product->des)  !!}
                </div>
            </div>

            @if(count($product->attributes) > 0)
                <div class="panel entry-content sp-tab des_mb_2 des_style_1 dn" id="tab_additional_information">
                    <div class="js_ck_view"></div>
                    <div class="heading bgbl dn">
                        <a class="tab-heading flex al_center fl_between pr cd chp fwm" href="#tab_additional_information">
                            <span class="txt_h_tab">{!! __('web/product.tab_additional_information') !!}</span><span class="nav_link_icon ml__5"></span></a>
                    </div>
                    <div class="sp-tab-content">
                        <table class="pr_attrs">
                            <tbody>
                            @foreach($product->attributes as $attribute)
                                <tr class="attr_pa_color">
                                    <th class="attr__label cb">{{$attribute->name}}</th>
                                    <td class="attr__value cb">
                                        <p>
                                            @foreach($valuesName->whereIn('id',json_decode($attribute->pivot->values, true)) as $value)
                                                {{$value->name}}
                                                @if(!$loop->last)
                                                    -
                                                @endif
                                            @endforeach
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if(issetArr($WebConfig,"pro_warranty_tab",1))
                <div class="panel entry-content sp-tab des_mb_2 des_style_1 dn" id="tab_warranty_and_shipping">
                    <div class="js_ck_view"></div>
                    <div class="heading bgbl dn">
                        <a class="tab-heading flex al_center fl_between pr cd chp fwm" href="#tab_warranty_and_shipping">
                            <span class="txt_h_tab">{!! __('web/product.tab_warranty') !!}</span><span class="nav_link_icon ml__5"></span></a>
                    </div>
                    <div class="sp-tab-content">
                        {!! $CashProductPageInfo[issetArr($WebConfig,"page_warranty",1)]->des ?? '' !!}
                    </div>
                </div>
            @endif

            @if(issetArr($WebConfig,"pro_shipping_tab",1))
                <div class="panel entry-content sp-tab des_mb_2 des_style_1 dn" id="tab_wash_and_care">
                    <div class="js_ck_view"></div>
                    <div class="heading bgbl dn">
                        <a class="tab-heading flex al_center fl_between pr cd chp fwm" href="#tab_wash_and_care">
                            <span class="txt_h_tab">{!! __('web/product.tab_shipping') !!}</span><span class="nav_link_icon ml__5"></span></a>
                    </div>
                    <div class="sp-tab-content">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{getDefPhotoPath($DefPhotoList,'shipping')}}" width="516" height="60" alt="shipping" class="img-fluid">
                            </div>
                            <div class="col-lg-8">
                                {!! $CashProductPageInfo[issetArr($WebConfig,"page_shipping",0)]->des ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif


        </div>
    </div>
</div>
