<div id="kalles-section-header_top" class="header_top">
  <div class="h__top bgbl pt__10 pb__10 fs__12 flex fl_center al_center header_top">
    <div class="container">
      <div class="row al_center top_banner_icon">
        <div class="@if(issetArr($WebConfig,"switch_lang",1)) col-lg-9 col-9 @endif tc tl_lg col-md-12 dn_false_1024">
          <span>
           <i class="lab la-whatsapp"></i><span class="number">{{$WebConfig->whatsapp_num}}</span>
          </span>
         <span>
           <i class="las la-phone-volume"></i><span class="number">{{$WebConfig->phone_num}}</span>
         </span>
        </div>

        @if(issetArr($WebConfig,"switch_lang",1))
          <div class="col-lg-3 col-3 text_left_lang">
            <a href="{{ LaravelLocalization::getLocalizedURL(webChangeLocale(),$pageView['slug']) }}">
              {{webChangeLocaletext()}}
            </a>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>