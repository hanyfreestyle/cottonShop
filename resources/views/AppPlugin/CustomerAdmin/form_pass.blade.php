@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>


  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <form class="mainForm" action="{{route($PrefixRoute.'.PasswordUpdate',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="form_type" value="{{$pageData['ViewType']}}">

        <div class="row">
          <x-admin.form.input :row="$rowData" :disabled="true" name="name" :label="__('web/profile.form_name')" col="6"/>
          @if($rowData->password_temp)
            <x-admin.form.input :row="$rowData" name="password_temp" :disabled="true" :label="__('web/profile.form_pass_new')" col="6" tdir="en"/>
          @endif
        </div>


        <div class="row">
          <x-admin.form.input name="password" type="password" label="{{__('web/profile.form_pass')}}" col="6"/>
          <x-admin.form.input name="password_confirmation" type="password" label="{{__('web/profile.form_pass_confirm')}}" col="6"/>
        </div>
        <hr>
        <x-admin.form.submit-role-back :page-data="$pageData"/>

      </form>
    </x-admin.card.def>
  </x-admin.hmtl.section>
@endsection


@push('JsCode')

@endpush
