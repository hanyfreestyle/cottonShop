@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.form.form-def :form-route="route($PrefixRoute.'.update',intval($rowData->id))" :row-data="$rowData" :page-data="$pageData">

{{--        <x-app-plugin.crm.customers.form-def :row-data="$rowData" :title="__('admin/crm/customers.box_def')"/>--}}

        <x-app-plugin.crm.customers.form-address :row-data="$rowData" :title="__('admin/crm/customers.box_address')"/>



{{--        <div class="box_form">--}}
{{--            <span class="box_title">fsdfsdf</span>--}}
{{--            <div class="row">--}}
{{--                <x-admin.form.textarea name="notes" :row="$rowData" :label="__($defLang.'form_notes')" col="6" tdir="en" :req="false"/>--}}
{{--            </div>--}}
{{--        </div>--}}


        <x-admin.form.submit-role-back :page-data="$pageData"/>
    </x-admin.form.form-def>

@endsection

@push('JsCode')

@endpush
