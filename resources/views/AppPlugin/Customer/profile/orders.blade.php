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


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection

