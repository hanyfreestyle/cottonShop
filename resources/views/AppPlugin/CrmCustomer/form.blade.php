@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.form.form-section :row-data="$rowData" :page-data="$pageData">
        <input type="hidden" name="phoneAreaCode" value="{{$phoneAreaCode}}" dir="ltr">

        <div class="row">
            <x-admin.form.input name="name" :row="$rowData" :label="__($defLang.'form_name')" col="6" tdir="ar"/>
            <x-admin.form.select-data name="evaluation_id" :row="$rowData" cat-id="EvaluationCust" :label="__($defLang.'form_evaluation')" :req="false"/>
        </div>

        <div class="row">
            <x-admin.form.phone name="mobile" :row="$rowData" :label="__($defLang.'form_mobile')" :initial-country="issetArr($rowData,'mobile_code',$defCountry)" col="3"/>
            <x-admin.form.phone name="mobile_2" :row="$rowData" :label="__($defLang.'form_mobile_2')" :initial-country="issetArr($rowData,'mobile_2_code',$defCountry)" col="3"
                                :req="false"/>
            <x-admin.form.phone name="phone" :row="$rowData" :label="__($defLang.'form_phone')" :initial-country="issetArr($rowData,'phone_code',$defCountry)" col="3"
                                :req="false"/>
            <x-admin.form.phone name="whatsapp" :row="$rowData" :label="__($defLang.'form_whatsapp')" :initial-country="issetArr($rowData,'whatsapp_code',$defCountry)" col="3"
                                :req="false"/>
        </div>


        <div class="row">
            <x-admin.form.input name="email" :row="$rowData" :label="__($defLang.'form_email')" col="3" tdir="en" :req="false"/>
        </div>

        <x-admin.form.textarea name="notes" :row="$rowData" :label="__($defLang.'form_notes')" col="12" tdir="en" :required-span="false"/>
        <hr>

        @if($pageData['ViewType'] == 'Add')

        @endif


        <div class="row">
            <x-admin.form.check-active :row="$rowData" name="is_active" page-view="{{$pageData['ViewType']}}"/>
        </div>
        <hr>
        <x-admin.form.submit-role-back :page-data="$pageData"/>

    </x-admin.form.form-section>



@endsection

@push('JsCode')

@endpush
