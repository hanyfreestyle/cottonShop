@extends('web.layouts.app')

@section('content')

  <div id="nt_content" class="mt__5">
    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('loginPage',$meta) }}
    </x-site.def.breadcrumbs>

    <x-site.def.h-title :title="$meta->name" :p="$meta->des"/>

    <div class="kalles-section container mb__100 profile_page profile_mt cb">
      <div class="container">
        <div class="row justify-content-md-center ">
          <div class="col col-lg-8 col-12 order-lg-2 order-2">

            <div class="card login_card">
              <div class="card-body">

                <x-site.html.confirm-massage/>
                <form action="{{route('Customer_Create')}}" method="post" class="myForm mb__10">
                  @csrf
                  <div class="form-row">
                    <x-site.form.input name="name" :label="__('web/profile.form_name')" value="{{old('name')}}" col="12"/>
                  </div>

                  <div class="form-row">
                    <x-site.form.phone name="phone" value="{{old('phone')}}" :label="__('web/profile.form_mobile')" col="6"/>
                    <x-site.form.input name="email" value="{{old('email')}}" :label="__('web/profile.form_email')" col="6"/>
                  </div>

                  <div class="form-row">
                    <x-site.form.input name="password" type="password" label="{{__('web/profile.form_pass')}}" col="6"/>
                    <x-site.form.input name="password_confirmation" type="password" label="{{__('web/profile.form_pass_confirm')}}" col="6"/>
                  </div>

                  <div class="form-row mt__20">
                    <div class="col text_left_lang">
                      <button class="btn def_but w_100" type="submit">{{ __('web/profile.form_text_sign_up') }}</button>
                    </div>
                  </div>
                  <div class="form_note text-center mt__20">
                    <a href="{{route('Customer_login')}}">{{ __('web/profile.but_login') }}</a>
                    <span>{{__('web/profile.form_text_have')}}</span>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col col-lg-4 sign_up_photo order-lg-1 order-1 ">
            <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="sign_up" def-name="photo" alt="sign up" :lazy-active="false"/>
          </div>

        </div>
      </div>
    </div>
  </div>







@endsection

