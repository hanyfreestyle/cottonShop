@extends('web.layouts.app')
@section('content')
  <div id="nt_content" class="mt__5">
    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('ContactUs',$meta) }}
    </x-site.def.breadcrumbs>

    <x-site.def.h-title :title="__('web/contact.h1')" :p="__('web/contact.h1_p')"/>

    <div class="kalles-section container mb__50 cb">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col col-lg-7 col-12 order-lg-2">
            <form action="{{route('ContactSaveForm')}}" method="post" class="myForm mb__10">
              @csrf
              <input type="hidden" name="request_type" value="1">
              <div class="my-4"></div>

              <div class="form-row">
                <x-site.form.input name="name" label="{{__('web/contact.form_name')}}" value="{{old('name')}}"/>
                <x-site.form.phone name="phone" value="{{old('phone')}}" label="{{__('web/contact.form_phone')}}"/>
              </div>

              <div class="form-row">
                <x-site.form.input name="subject" label="{{__('web/contact.form_subject')}}" value="{{old('subject')}}" col="12"/>
              </div>

              <div class="form-row">
                <x-site.form.text-area name="message" value="{{old('message')}}" col="12" label="{{__('web/contact.form_message')}}"/>
              </div>

              <div class="form-row ">
                <div class="col text_left_lang">
                  <button class="btn def_but w_100" type="submit">{{__('web/contact.form_send')}}</button>
                </div>

              </div>
            </form>
          </div>

          <div class="col col-lg-3 conatct_us_photo order-lg-1 d-none d-lg-block ">
            <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="contact_us" def-name="photo" alt="404" :lazy-active="false"
                            class="img-fluid"/>
          </div>

        </div>
      </div>
    </div>

    <x-temp.footer-icon/>


  </div>
@endsection