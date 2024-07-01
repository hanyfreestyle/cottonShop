@extends('admin.layouts.app')

@section('StyleFile')
  <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

  <x-admin.hmtl.section>

    <x-admin.product.filter :row="$rowData" form-name="{{$formName}}"/>
  </x-admin.hmtl.section>

  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
        @include('AppPlugin.Product.index_header')
        <tbody>
        </tbody>
      </table>
    </x-admin.card.def>


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
              pageLength: 25,
              order: [0, 'desc'],

            @include('datatable.lang')
            ajax: "{{ $route }}",


              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'photo', name: 'photo', orderable: false, searchable: false},


                  {data: 'tablename.0.name', name: 'tablename.name'},
                  @if(count(config('app.web_lang')) > 1 and config('AppPlugin.BlogPost.table_all_lang'))
                  {
                      data: 'tablename.1.name', name: 'tablename.name'
                  },
                  @endif

                  {
                      data: 'CatName', name: 'CatName', orderable: false, searchable: false
                  },
                  {
                      data: 'Brand', name: 'Brand', orderable: false, searchable: false
                  },

                  {
                      data: 'regular_price', name: 'regular_price', orderable: true, searchable: true,
                  },

                  {
                      data: 'price', name: 'price', orderable: true, searchable: true,
                  },


                  @can($PrefixRole.'_edit')
                  @if(config('AppPlugin.BlogPost.table_photos'))
                  {
                      data: 'MorePhoto', name: 'MorePhoto', orderable: false, searchable: false
                  },
                  @endif
                  {
                      data: 'Edit', name: 'Edit', orderable: false, searchable: false
                  },
                  @endcan

                  @can($PrefixRole.'_delete')
                  {
                      data: 'Delete', name: 'Delete', orderable: false, searchable: false
                  },
                @endcan
              ],

          });
      });
  </script>
@endpush

