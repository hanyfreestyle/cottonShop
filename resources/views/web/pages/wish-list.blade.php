@extends('web.layouts.app')
@section('content')

  <div id="nt_content mt__10">

    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('WishList',$meta) }}
    </x-site.def.breadcrumbs>

    <x-site.def.h-title :title="$meta->name" :p="$meta->des"/>

    <div class="container container_cat pop_default cat_default mb__20">

      @if(Auth::guard('customer')->check())

        <div class="row mt__20">
          <div class="js_sidebar sidebar sidebar_nt col-lg-3 order-1  col-12 space_30 hidden_false lazyload">
            <x-temp.tools.side-bar :brand-limit="10"/>
          </div>

          <div class="col-lg-9 order-2 col-12">
            <livewire:site.favorite-page-view/>
          </div>
        </div>
      @else
        <div class="container mt__50">
          @include('AppPlugin.Customer.auth.login_form')
        </div>
      @endif
    </div>
  </div>


  <div id="nt_content" class="mt__50">
    <x-temp.footer-icon/>
  </div>

@endsection
