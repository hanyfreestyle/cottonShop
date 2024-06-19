@extends('web.layouts.app')

@section('content')
  <div id="nt_content" class="mt__5">
    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('loginPage',$meta) }}
    </x-site.def.breadcrumbs>

    <x-site.def.h-title :title="$meta->name" :p="$meta->des"/>

    <div class="kalles-section container mb__100 profile_page profile_mt cb">
      <div class="container">
        @include('AppPlugin.Customer.auth.login_form')
      </div>
    </div>
  </div>
@endsection

