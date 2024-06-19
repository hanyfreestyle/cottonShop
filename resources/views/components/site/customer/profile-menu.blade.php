<ul class="nav ProfileMenuList flex-column">

  {{--        @if(count($CartContent) > 0)--}}
  {{--            <li class="nav-item">--}}
  {{--                <a href="{{route('Shop_CartView')}}" class="nav-link @if($pageView['profileMenu'] == 'ProfileCart' ) active @endif">--}}
  {{--                    <i class="fas fa-shopping-cart"></i> {{__('web/customers.Profile_cart')}}--}}
  {{--                </a>--}}
  {{--            </li>--}}
  {{--        @endif--}}

  {{--        <li class="nav-item">--}}
  {{--            <a href="{{route('Profile_OrdersList')}}" class="nav-link @if($pageView['profileMenu'] == 'OrdersList' ) active @endif">--}}
  {{--                <i class="fas fa-folder-open"></i>{{__('web/profile.menu_orders_list')}}--}}
  {{--            </a>--}}
  {{--        </li>--}}

  <li class="nav-items {{activeProfileMenu($pageView,"cart_page")}}">
    <a href="{{route('Shop_CartView')}}" class="nav-link">
      <i class="las la-shopping-cart"></i> {{__('web/profile.menu_cart')}}
    </a>
  </li>

  <li class="nav-items {{activeProfileMenu($pageView,"orders")}}">
    <a href="{{route('Customer_Orders')}}" class="nav-link">
      <i class="lab la-cc-visa"></i> {{__('web/profile.menu_orders_list')}}
    </a>
  </li>


  <li class="nav-items {{activeProfileMenu($pageView,"wish_list")}}">
    <a href="{{route('page_WishList')}}" class="nav-link">
      <i class="las la-heart"></i> {{__('web/profile.menu_wish_list')}}
    </a>
  </li>

  <li class="nav-items {{activeProfileMenu($pageView,"accountInfo")}}">
    <a href="{{route('Customer_Profile')}}" class="nav-link">
      <i class="lar la-address-card"></i> {{__('web/profile.menu_account_info')}}
    </a>
  </li>

  <li class="nav-item {{activeProfileMenu($pageView,"AddressInfo")}}">
    <a href="{{route('Profile_Address')}}" class="nav-link">
      <i class="las la-map-signs"></i> {{__('web/profile.menu_address')}}
    </a>
  </li>

  <li class="nav-item {{activeProfileMenu($pageView,"ChangePassword")}}">
    <a href="{{route('Profile_ChangePassword')}}" class="nav-link">
      <i class="las la-key"></i> {{__('web/profile.menu_change_pass')}}
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('Customer_logout') }}">
      <i class="las la-unlock-alt"></i> {{__('web/profile.but_logout')}}
    </a>
  </li>


  {{--  <li class="nav-item">--}}
  {{--    <a class="nav-link" href="{{ route('Customer_logout') }}"--}}
  {{--       onclick="event.preventDefault(); document.getElementById('logout-formX').submit();">--}}
  {{--      <i class="las la-unlock-alt"></i> {{__('web/profile.but_logout')}}--}}
  {{--    </a>--}}
  {{--  </li>--}}
  {{--  <form id="logout-formX" action="{{ route('Customer_logout') }}" method="POST" class="d-none">--}}
  {{--    @csrf--}}
  {{--  </form>--}}
</ul>

