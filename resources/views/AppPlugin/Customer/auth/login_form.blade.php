<div class="row justify-content-md-center ">
  <div class="col col-lg-6 col-12 offset-md-1 order-lg-2 order-2">

    <div class="card login_card">
      <div class="card-body">

        <x-site.html.confirm-massage/>
        <form action="{{route('Customer_loginCheck',$cart)}}" method="post" class="myForm mb__10">
          @csrf
          <div class="form-row  mt__10">
            <x-site.form.phone name="phone" col="12" value="{{old('phone')}}" label="{{__('web/profile.form_mobile')}}"/>
          </div>

          <div class="form-row">
            <x-site.form.input name="password" type="password" label="{{__('web/profile.form_pass')}}" value="{{old('password')}}"
                               col="12"/>
          </div>
          <div class="form-row mt__20">
            <div class="col text_left_lang">
              <button class="btn def_but w_100" type="submit">{{ __('web/profile.but_login') }}</button>
            </div>
          </div>
          <div class="form_note text-center mt__20">
            <a href="{{route('Customer_Register')}}">{!! __('web/profile.form_text_sign_up') !!}</a>
            <span>{!! __('web/profile.form_text_have_no') !!}</span>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col col-lg-5 login_photo order-lg-1 order-1">
    <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="login" def-name="photo" alt="login" :lazy-active="false"
                    class="img-fluid"/>
  </div>

</div>
