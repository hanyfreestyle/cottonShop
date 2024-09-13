<footer id="nt_footer" class="bgbl footer-1">
    <div id="kalles-section-footer_top" class="kalles-section footer__top type_instagram">
        <div class="footer__top_wrap footer_sticky_false footer_collapse_true nt_bg_overlay pr oh pb__10 pt__60">
            <div class="container pr z_100">
                <div class="row justify-content-md-center">
                    <div class="col-lg-4 col-md-6 col-12 mb__20 order-lg-1 order-1">
                        <div class="widget widget_nav_menu">
                            <div class="widget_footer">
                                <div class="footer-contact">
                                    <p class="footer_logo text-center">
                                        <a href="{{route('page_index')}}" class="link d-inline-block mb-6">
                                            <img src="{{getDefPhotoPath($DefPhotoList,'light_logo')}}" width="516" height="60" alt="logo"
                                                 class="footer_logo img-fluid">
                                        </a>
                                    </p>
                                    <p>
                                        {!! __('web/footer.about_p') !!}<a href="#" class="footer_read_more">... {{__('web/def.but_show_more')}}</a>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb__20 order-lg-2 order-1">
                        <div class="widget widget_nav_menu">
                            <h3 class="widget-title fwsb flex al_center fl_between fs__16 mg__0 mb__10">
                                <span class="txt_title">{{__('web/footer.h3_menu')}}</span><span class="nav_link_icon ml__5"></span>
                            </h3>
                            <div class="menu_footer widget_footer">
                                <ul class="menu">
                                    <li class="menu-item"><a href="{{route('page_index')}}">{{__('web/menu.main_home_page')}}</a></li>
{{--                                    <li class="menu-item"><a href="{{route('page_Offers')}}">{{__('web/menu.main_offers')}}</a></li>--}}
                                    <li class="menu-item"><a href="{{route('page_AboutUs')}}">{{__('web/menu.main_about')}}</a></li>
                                    <li class="menu-item"><a href="{{route('BlogList')}}">{{__('web/menu.main_blog')}}</a></li>
{{--                                    <li class="menu-item"><a href="{{route('page_Trems')}}">{!! __('web/menu.main_terms_2') !!}</a></li>--}}
                                    @foreach($policyPages as $page)
                                        <li class="menu-item"><a href="{{route('page_policy',$page->slug)}}">{{$page->name}}</a></li>
                                    @endforeach
                                    <li class="menu-item"><a href="{{route('page_ContactUs')}}">{{__('web/menu.main_contatc_us')}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 mb__20 order-lg-3 order-1">
                        <div class="widget widget_nav_menu">
                            <h3 class="widget-title fwsb flex al_center fl_between fs__16 mg__0 mb__10">
                                <span class="txt_title">{{__('web/footer.h3_brand')}}</span><span class="nav_link_icon ml__5"></span>
                            </h3>
                            <div class="menu_footer widget_footer">
                                <ul class="menu">
                                    @foreach($CashBrandMenuList->take(6) as $brand)
                                        <li class="menu-item">
                                            <a href="{{route('BrandView',$brand->slug)}}">{{$brand->name}}
                                                <span class="pro_count">{{$brand->products_count}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <p class="text_left_lang">
                                    <a href="{{route('BrandList')}}" class="footer_read_more">{{__('web/def.but_show_more')}}</a>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12 mb__20 order-lg-4 order-1">
                        <div class="widget widget_nav_menu">
                            <h3 class="widget-title fwsb flex al_center fl_between fs__16 mg__0 mb__10">
                                <span class="txt_title">{{__('web/footer.h3_categories')}}</span><span class="nav_link_icon ml__5"></span>
                            </h3>
                            <div class="menu_footer widget_footer">
                                <ul class="menu">
                                    @foreach($CashCategoryMenuList->take(6) as $category)
                                        <li class="menu-item">
                                            <a href="{{route('ProductsCategoriesView',$category->slug)}}">{{$category->name}}
                                                <span class="pro_count">{{$category->products_count}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <p class="text_left_lang">
                                    <a href="#" class="footer_read_more">{{__('web/def.but_show_more')}}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6 col-12 mb__50 order-lg-5 order-1">
                        <livewire:site.news-letter-form/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kalles-section-footer_bot" class="kalles-section footer__bot">
        <div class="footer__bot_wrap pt__20 pb__20">
            <div class="container pr tc">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 col_1">{!! GetCopyRight('2008',$WebConfig->name ) !!}</div>
                </div>
            </div>
        </div>
    </div>
</footer>
