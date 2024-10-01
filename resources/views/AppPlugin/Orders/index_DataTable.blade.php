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
      <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
        @include('AppPlugin.Orders.index_header')
        <tbody>
        </tbody>
      </table>
    </x-admin.card.normal>
  </x-admin.hmtl.section>

@endsection

@push('JsCode')
  <x-admin.data-table.sweet-dalete/>
  <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable"/>
  <script type="text/javascript">
      $(function () {
          var table = $('.DataTableView').DataTable({
              processing: true,
              serverSide: true,
              pageLength: 10,
              order: [0, 'desc'],
            @include('datatable.lang')
            ajax: "{{ route($PrefixRoute.'.DataTable',['id'=> $OrderStatus]) }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {
                      'name': 'order_date',
                      'data': {
                          '_': 'order_date.display',
                          'sort': 'order_date.timestamp'
                      }
                  },
                  {data: 'payment_method', name: 'payment_method', orderable: false, searchable: false},
                  {data: 'payment_method_state', name: 'payment_method_state', orderable: false, searchable: false},
                  @if($OrderStatus == 3)
                  {
                      'name': 'delivery_date',
                      'data': {
                          '_': 'delivery_date.display',
                          'sort': 'delivery_date.timestamp'
                      }
                  },
                  @endif

                  {data: 'city', name: 'address.city', orderable: false, searchable: true},
                  {data: 'name', name: 'address.name', orderable: false, searchable: true},
                  {data: 'phone', name: 'address.phone', orderable: false, searchable: true},
                  {data: 'total', name: 'total', orderable: true, searchable: true},
                  {data: 'shipping', name: 'shipping', orderable: false, searchable: false},
                  {data: 'total_invoice', name: 'total_invoice', orderable: true, searchable: true},
                  {data: 'view', name: 'view', orderable: false, searchable: false},

              ]
          });
      });
  </script>
@endpush

