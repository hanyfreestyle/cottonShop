@extends('web.layouts.app')
@section('content')
  <div id="nt_content" class="mt__5">
    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('ContactUs',$meta) }}
    </x-site.def.breadcrumbs>

    <x-site.def.h-title :title="__('web/contact.thanks_h1')" :p="__('web/contact.thanks_p')"/>

    <div class="kalles-section container mb__50 cb">
      <div class="row justify-content-center ">
        <div class="col-lg-7 ThanksPage">
          <div class="text-center">
            <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="thanks" def-name="photo" alt="thanks" class="img-fluid"/>
          </div>
          <div class="text-center mt__20">
            <a href="{{route('page_index')}}" class="btn def_but">{{__('web/contact.form_back_to_home')}}</a>
          </div>

        </div>
      </div>
    </div>
  </div>

  <x-temp.footer-icon/>
@endsection
