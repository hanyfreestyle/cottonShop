@extends('admin.layouts.app')

@section('StyleFile')
  <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  @if($pageData['ViewType'] == 'List')
    <x-admin.hmtl.section>
      <x-admin.orders.filter :row="$rowData" form-name="{{$formName}}" def-route=".filter"/>
    </x-admin.hmtl.section>
  @endif

  <x-admin.hmtl.section>
    <x-admin.card.normal :title="__('admin/orders.app_menu_status_'.$OrderStatus)">
      @if(count($rowData)>0)
        <div class="card-body table-responsive p-0">
          <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
            @include('AppPlugin.Orders.index_header')
            <tbody>

            @foreach($rowData as $order)
              <tr>
                <td>{{$order->id+1000}}</td>
                <td>{{$order->orderDate()}}</td>
                @if($OrderStatus == 3)
                  <td>{{$order->deliveryDate()}}</td>
                @endif

                <td>{{$order->address->city}}</td>
                <td>{{$order->address->name}}</td>
                <td>{{$order->address->phone}}</td>

                <td>{{ number_format($order->total) }}</td>
                <td>{{ number_format($order->shipping) }}</td>
                <td>{{ number_format($order->total_invoice) }}</td>
                <td class="td_action">
                  <x-admin.form.action-button url="{{route($PrefixRoute.'.OrderView',$order->uuid)}}" icon="fas fa-search"/>
                </td>

              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      @else
        <x-admin.hmtl.alert-massage type="nodata"/>
      @endif
    </x-admin.card.normal>
    <x-admin.hmtl.pages-link :row="$rowData"/>

  </x-admin.hmtl.section>
@endsection

@push('JsCode')
  <x-admin.table.sweet-delete-js/>
  <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable"/>
@endpush

