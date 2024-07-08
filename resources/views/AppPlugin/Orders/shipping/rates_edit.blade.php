@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    @include('AppPlugin.Orders.shipping.rates_form_inc',[
    'ptype'=>'Edit',
    'cat_id'=>$rowData->cat_id,
    'rateId'=> $rowData->id,
    'title'=>__('admin/orders.shipping_reate_add')
    ])

@endsection
