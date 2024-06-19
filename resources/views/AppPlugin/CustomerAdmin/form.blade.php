@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>


  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <form class="mainForm" action="{{route($PrefixRoute.$route,intval($rowData->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="form_type" value="{{$pageData['ViewType']}}">

        <div class="row">
          <x-admin.form.input :row="$rowData" name="name" :label="__('web/profile.form_name')" col="9"/>
          <x-admin.form.select-arr name="city_id" sendvalue="{{old('city_id',$rowData->city_id)}}" :required-span="false"
                                   :send-arr="$cashCityList" label="{{__('admin/orders.title_city')}}" col="3"/>
        </div>

        <div class="row">
          <x-admin.form.input :row="$rowData" name="phone" :label="__('web/profile.form_mobile')" col="6"/>
          <x-admin.form.input :row="$rowData" name="whatsapp" :label="__('web/profile.form_whatsapp')" :req="false" col="6"/>
          <x-admin.form.input :row="$rowData" name="email" :label="__('web/profile.form_email')" :req="false" col="6"/>
        </div>

        <hr>

        <div class="row">
          <x-admin.form.check-active name="is_active" :row="$rowData" lable="{{__('admin/def.status')}}" :page-view="$pageData['ViewType']"/>
        </div>

        <x-admin.form.submit-role-back :page-data="$pageData"/>

      </form>
    </x-admin.card.def>
  </x-admin.hmtl.section>
@endsection


@push('JsCode')

@endpush
