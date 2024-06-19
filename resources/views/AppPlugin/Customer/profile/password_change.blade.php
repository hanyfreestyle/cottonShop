@extends('web.layouts.app')

@section('content')

  <div id="nt_content" class="mt__5">
    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('loginPage',$meta) }}
    </x-site.def.breadcrumbs>

    <div class="kalles-section container mb__100 profile_page mt__20 cb">
      <div class="container">
        <div class="row justify-content-md-center">

          <div class="col col-lg-3 login_photo order-lg-1 order-1 d-none d-lg-block">
            <x-site.customer.profile-menu :page-view="$pageView"/>
          </div>

          <div class="col col-lg-9 col-12 order-lg-2 order-2">

            <div class="card profile_card">

              <div class="card-header">
                <h3><i class="las la-key"></i>{{__('web/profile.menu_change_pass')}}</h3>
              </div>

              <div class="card-body">

                <x-site.html.confirm-massage/>

                <form action="{{route('Profile_ChangePasswordUpdate')}}" method="post" class="myForm mb__10">
                  @csrf

                  <div class="form-row">
                    <x-site.form.input name="old_password" type="password" :label="__('web/profile.form_pass_old')" col="12"/>
                    <x-site.form.input name="password" type="password" :label="__('web/profile.form_pass_new')" col="12"/>
                    <x-site.form.input name="password_confirmation" type="password" :label="__('web/profile.form_pass_confirm')" col="12"/>
                  </div>

                  <div class="form-row mt__20">
                    <div class="col text_left_lang">
                      <button class="btn def_but" type="submit"> {{__('web/profile.but_update_pass')}}</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

