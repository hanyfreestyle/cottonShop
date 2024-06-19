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
                <h3><i class="las la-map-signs"></i> {{__('web/profile.menu_address')}}</h3>
              </div>

              <div class="card-body">

                <x-site.html.confirm-massage/>

                <div class="row">
                  @if($customer->addresses_count > 0)
                    @foreach($customer->addresses as $address)
                      <div class="col-lg-6 mt-3 mb-3">
                        @include('AppPlugin.Customer.profile.address_block',['page_type'=> 'profile'])
                      </div>
                    @endforeach
                  @else
                    <div class="col-lg-12">
                      <div class="alert alert-warning alert-dismissible">
                        {{__('web/profile.address_no_data')}}
                      </div>
                    </div>
                  @endif
                </div>
              </div>
            </div>

            @if($customer->addresses_count < 4)
              <div class="row mt__15">
                <div class="col-12 card_but">
                  <a href="{{route('Profile_Address_Add')}}" class="btn btn-dark rounded-0">{{__('web/profile.address_add_new')}}</a>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

