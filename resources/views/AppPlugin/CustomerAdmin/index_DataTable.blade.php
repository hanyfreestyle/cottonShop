@extends('admin.layouts.app')

@section('StyleFile')
  <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
        @include('AppPlugin.CustomerAdmin.index_header')
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
            ajax: "{{ route($PrefixRoute.'.DataTable') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {
                      'name': 'created_at',
                      'data': {
                          '_': 'created_at.display',
                          'sort': 'created_at.timestamp'
                      }
                  },

                  {data: 'name', name: 'name', orderable: true, searchable: true},
                  {data: 'city', name: 'city.0.name', orderable: true, searchable: false},
                  {data: 'phone', name: 'phone', orderable: true, searchable: true},


                  {data: 'is_active', name: 'is_active', orderable: false, searchable: false},

                  @can($PrefixRole.'_edit')
                  {
                      data: 'Edit', name: 'Edit', orderable: false, searchable: false
                  },
                  {
                      data: 'Password', name: 'Password', orderable: false, searchable: false
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

