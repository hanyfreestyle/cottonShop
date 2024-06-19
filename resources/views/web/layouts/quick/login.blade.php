<div id="nt_login_canvas" class="nt_fk_canvas dn lazyload">
  @if(Auth::guard('customer')->check())
    <form id="customer_login" class="nt_mini_cart flex column h__100 is_selected">

      <div class="mini_cart_header flex fl_between al_center">
        <div class="h3 widget-title tu fs__16 mg__0">{{__('web/menu.sticky_account')}}</div>
        <i class="close_pp pegk pe-7s-close ts__03 cd"></i>
      </div>
      <div class="mini_cart_wrap">
        <div class="mini_cart_content fixcl-scroll">
          <div class="fixcl-scroll-content">
            <div class="profileUserInfo">
              <div class="welcome">{!! __('web/profile.profile_welcome') !!}</div>
              <div class="name">{{Auth::guard('customer')->user()->name}}</div>
              <div class="photo">
                <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="user_avatar" def-name="photo" alt="login" :lazy-active="false"/>
              </div>
            </div>

            <x-site.customer.profile-menu :page-view="$pageView"/>

          </div>
        </div>
      </div>
    </form>

  @else
    <form id="customer_login" method="post" action="{{route('Customer_loginCheck',$cart)}}"
          class="nt_mini_cart flex column h__100 is_selected">
      @csrf
      <div class="mini_cart_header flex fl_between al_center">
        <div class="h3 widget-title tu fs__16 mg__0">{{__('web/profile.form_h1_login')}}</div>
        <i class="close_pp pegk pe-7s-close ts__03 cd"></i>
      </div>
      <div class="mini_cart_wrap">
        <div class="mini_cart_content fixcl-scroll">
          <div class="fixcl-scroll-content">
            <div class="mobile_login_photo">
              <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="login" def-name="photo" alt="login" :lazy-active="false"/>
            </div>

            <div class="form-row  mt__10">
              <x-site.form.input name="phone" col="12" value="01223129660" label="{{__('web/profile.form_mobile')}}"/>
            </div>
            <div class="form-row">
              <x-site.form.input name="password" type="password" value="01223129660" label="{{__('web/profile.form_pass')}}" col="12"/>
            </div>

            <input type="submit" class="button button_primary w__100 tu mt__10 mt__20 js_add_ld" value="{{ __('web/profile.but_login') }}">
            <br>
            <p class="mb__10 mt__20">{!! __('web/profile.form_text_have_no') !!}
              <a href="{{route('Customer_Register')}}" class="def_color">{!! __('web/profile.form_text_sign_up') !!}</a>
            </p>
          </div>
        </div>
      </div>
    </form>
  @endif
</div>