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
                                </div>
                            </div>
                        </div>
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
