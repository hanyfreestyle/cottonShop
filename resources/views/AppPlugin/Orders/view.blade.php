@extends('admin.layouts.app')
@section('StyleFile')
  <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

  <x-admin.hmtl.section>
    <div class="row">
      <div class="col-lg-8">
        @include('AppPlugin.Orders.invoce_inc')
      </div>

      @can('orders_edit')
        <div class="col-lg-4">
          @if($order->status == 1)
            @include('AppPlugin.Orders.form')
          @elseif($order->status == 2)
            @include('AppPlugin.Orders.form')
          @elseif($order->status == 3)
            <x-admin.orders.log :order="$order"/>
          @elseif($order->status == 4)
            <x-admin.orders.log :order="$order"/>
          @endif
        </div>
      @endcan

    </div>

  </x-admin.hmtl.section>



@endsection

@push('JsCode')

@endpush
