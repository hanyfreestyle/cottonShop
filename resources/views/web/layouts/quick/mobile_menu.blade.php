<div id="nt_menu_canvas" class="nt_fk_canvas nt_sleft dn lazyload">
  <i class="close_pp pegk pe-7s-close ts__03 cd"></i>
  <div class="mb_nav_tabs flex al_center mb_cat_true">
    <div class="mb_nav_title pr mb_nav_ul flex al_center fl_center active" data-id="#kalles-section-mb_nav_js">
      <span class="db truncate">{{__('web/menu.mobile_t_menu')}}</span>
    </div>
    <div class="mb_nav_title pr flex al_center fl_center" data-id="#kalles-section-mb_cat_js">
      <span class="db truncate">{{__('web/menu.mobile_t_categories')}}</span>
    </div>
  </div>
  <div id="kalles-section-mb_nav_js" class="mb_nav_tab active">
    <div id="kalles-section-mb_nav" class="kalles-section">
      <ul id="menu_mb_ul" class="nt_mb_menu">
        <li class="menu-item mobileMenu_{{activeMenu($pageView,'HomePage')}}"><a href="{{route('page_index')}}">
            <span><i class="las la-home mr__10 fs__20"></i>{{__('web/menu.main_home_page')}}</span></a>
        </li>

        <li class="menu-item mobileMenu_{{activeMenu($pageView,'Offers')}}"><a href="{{route('page_index')}}">
            <span><i class="las la-percent mr__10 fs__20"></i>{{__('web/menu.main_offers')}}</span></a>
        </li>
        <li class="menu-item menu-item-has-children only_icon_false mobileMenu_{{activeMenu($pageView,'Brand')}}">
          <a href="{{route('BrandList')}}"><span class="nav_link_txt flex al_center"><i class="las la-registered mr__10 fs__20"></i>
              {{__('web/menu.mobile_brand')}}</span><span class="nav_link_icon ml__5"></span>
          </a>
          <ul class="sub-menu">
            @foreach($CashBrandMenuList->take(10) as $brand)
              <li class="menu-item"><a href="{{route('BrandView',$brand->slug)}}">{{$brand->name}}</a></li>
            @endforeach
          </ul>
        </li>


        <li class="menu-item mobileMenu_{{activeMenu($pageView,'AboutUs')}}"><a href="{{route('page_AboutUs')}}">
            <span><i class="las la-pen-nib mr__10 fs__20"></i>{{__('web/menu.main_about')}}</span></a>
        </li>

        <li class="menu-item mobileMenu_{{activeMenu($pageView,'BlogList')}}"><a href="{{route('BlogList')}}">
            <span><i class="las la-rss mr__10 fs__20"></i>{{__('web/menu.main_blog')}}</span></a>
        </li>


        @if(issetArr($WebConfig,"pro_social_share",1))
        @endif


        @if(issetArr($WebConfig,"wish_list",1))
          <li class="menu-item mobileMenu_{{activeMenu($pageView,'wishlist')}}"><a href="{{route('page_WishList')}}">
              <span><i class="las la-heart mr__10 fs__20"></i>{{__('web/menu.mobile_wishlist')}}</span></a>
          </li>
        @endif

        @if(issetArr($WebConfig,"serach",1))
          @if(issetArr($WebConfig,"serach_type",null) == 1)
            <li class="menu-item push_side" data-id="#nt_search_canvas"><a href="#">
                <span><i class="las la-search mr__10 fs__20"></i>{{__('web/menu.sticky_search')}}</span></a>
            </li>
          @else
            <li class="menu-item"><a href="{{route('page_search')}}">
                <span><i class="las la-search mr__10 fs__20"></i>{{__('web/menu.sticky_search')}}</span></a>
            </li>
          @endif
        @endif

        @if(issetArr($WebConfig,"users_login",1))
          <li class="menu-item push_side mobileMenu_{{activeMenu($pageView,'profile_page')}}" data-id="#nt_login_canvas"><a href="#">
              <span><i class="las la-user mr__10 fs__20"></i>{{__('web/menu.mobile_login')}}</span></a>
          </li>
        @endif

        <li class="menu-item mobileMenu_{{activeMenu($pageView,'page_Trems')}}"><a href="{{route('page_Trems')}}">
            <span><i class="las la-gavel mr__10 fs__20"></i>{!! __('web/menu.main_terms') !!}</span></a>
        </li>

        <li class="menu-item mobileMenu_{{activeMenu($pageView,'contact')}}"><a href="{{route('page_ContactUs')}}">
            <span><i class="las la-phone-volume mr__10 fs__20"></i>{{__('web/menu.main_contatc_us')}}</span></a>
        </li>

        @if(issetArr($WebConfig,"switch_lang",1))
          <li class="menu-item"><a href="{{ LaravelLocalization::getLocalizedURL(webChangeLocale(),$pageView['slug']) }}">
              <span><i class="las la-language mr__10 fs__20"></i> {{webChangeLocaletext()}}</span></a>
          </li>
        @endif








        <li class="menu-item menu-item-infos">
          <p class="menu_infos_title text-center">{{__('web/menu.mobile_text_help')}}</p>
          <div class="menu_infos_text mobile_help_text text-center">
            <div><i class="lab la-whatsapp"></i><span class="number">{{$WebConfig->whatsapp_num}}</span></div>
            <div><i class="las la-phone-volume"></i></i><span class="number">{{$WebConfig->phone_num}}</span></div>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <div id="kalles-section-mb_cat_js" class="mb_nav_tab">
    <div id="kalles-section-mb_cat" class="kalles-section">
      <ul id="menu_mb_cat" class="nt_mb_menu">
        @foreach($CashCategoryMenuList->take(30) as $category)
          <li class="menu-item @if($category->children_web_count > 0) menu-item-has-children only_icon_false @endif">
            <a href="{{route('ProductsCategoriesView',$category->slug)}}">
              <span class="nav_link_txt flex al_center"><i class="las la-angle-double-left mr__10 fs__20"></i>{{$category->name}}</span>
              @if($category->children_web_count > 0)
                <span class="nav_link_icon ml__5"></span>
              @endif
            </a>
            @if($category->children_web_count > 0)
              <ul class="sub-menu">
                @foreach($category->childrenWeb as $children)
                  <li class="menu-item"><a href="{{route('ProductsCategoriesView',$children->slug)}}">{{$children->name}}</a></li>
                @endforeach
              </ul>
            @endif
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>