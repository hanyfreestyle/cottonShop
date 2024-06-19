<div class="sp_header_mid">
  <div class="header__mid">
    <div class="container">
      <div class="row al_center css_h_se">
        <div class="col-md-4 col-3 dn_lg">
          <a href="#" data-id="#nt_menu_canvas" class="push_side push-menu-btn  lh__1 flex al_center">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" viewBox="0 0 30 16">
              <rect width="30" height="1.5"></rect>
              <rect y="7" width="20" height="1.5"></rect>
              <rect y="14" width="30" height="1.5"></rect>
            </svg>
          </a></div>
        <div class="col-lg-2 col-md-4 col-6 tc tl_lg">
          <div class=" branding ts__05 lh__1">
            <a class="dib" href="{{route('page_index')}}">
              <img src="{{getDefPhotoPath($DefPhotoList,'dark_logo')}}" width="516" height="60" alt="logo"
                   class="header_logo img-fluid">
            </a>
          </div>
        </div>
        <div class="col dn db_lg">
          <nav class="nt_navigation kl_navigation tc hover_side_up nav_arrow_false">
            <ul id="nt_menu_id" class="nt_menu in_flex wrap al_center">

              <li class="menu-item menu_has_offsets menu_right pos_right">
                <a class="lh__1 flex al_center pr {{activeMenu($pageView,'HomePage')}}" href="{{route('page_index')}}">{{__('web/menu.main_home_page')}}</a>
              </li>
              <li class="menu-item menu_has_offsets menu_right pos_right">
                <a class="lh__1 flex al_center pr {{activeMenu($pageView,'AboutUs')}}" href="{{route('page_AboutUs')}}">{{__('web/menu.main_about')}}</a>
              </li>
              <li class="menu-item menu_has_offsets menu_right pos_right">
                <a class="lh__1 flex al_center pr {{activeMenu($pageView,'shop')}}" href="{{route('page_ShopView')}}">{{__('web/menu.main_shop')}}</a>
              </li>
              <li class="menu-item menu_has_offsets menu_right pos_right">
                <a class="lh__1 flex al_center pr {{activeMenu($pageView,'Offers')}}" href="{{route('page_Offers')}}">{{__('web/menu.main_offers_2')}}</a>
              </li>

              <li class="menu-item menu_has_offsets menu_right pos_right">
                <a class="lh__1 flex al_center pr {{activeMenu($pageView,'ProductsCategories')}}" href="{{route('ProductsCategoriesList')}}">{{__('web/menu.mobile_t_categories')}}</a>
              </li>
              <li class="menu-item menu_has_offsets menu_right pos_right">
                <a class="lh__1 flex al_center pr {{activeMenu($pageView,'Brand')}}" href="{{route('BrandList')}}">{{__('web/menu.mobile_brand')}}</a>
              </li>

              <li class="menu-item menu_has_offsets menu_right pos_right">
                <a class="lh__1 flex al_center pr {{activeMenu($pageView,'BlogList')}}" href="{{route('BlogList')}}">{{__('web/menu.main_blog')}}</a>
              </li>
              <li class="menu-item menu_has_offsets menu_right pos_right">
                <a class="lh__1 flex al_center pr {{activeMenu($pageView,'contact')}}" href="{{route('page_ContactUs')}}">{{__('web/menu.main_contatc_us')}}</a>
              </li>

            </ul>
          </nav>
        </div>
        <div class="col-lg-auto col-md-4 col-3 tr col_group_btns">
          <div class="nt_action in_flex al_center cart_des_1">

            @if(issetArr($WebConfig,"serach",1))
              @if(issetArr($WebConfig,"serach_type",null) == 1)
                <a class="icon_search push_side cb chp" data-id="#nt_search_canvas" href="#"><i class="las la-search"></i></a>
              @else
                <a class="icon_search cb chp" href="{{route('page_search')}}"><i class="las la-search"></i></a>
              @endif
            @endif

            @if(issetArr($WebConfig,"users_login",1))
              <div class="my-account ts__05 pr dn db_md">
                <a class="cb chp db push_side {{activeMenu($pageView,'profile_page')}}" href="#" data-id="#nt_login_canvas"><i class="las la-user"></i></a>
              </div>
            @endif

            @if(issetArr($WebConfig,"wish_list",1))
              <a class="icon_like cb chp pr dn db_md js_link_wis" href="{{route('page_WishList')}}">
                <i class="lar la-heart pr">
                  <livewire:site.favorite-menu/>
                </i>
              </a>
            @endif

           <div class="icon_cart pr">
              <livewire:site.cart.menu-icon/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>