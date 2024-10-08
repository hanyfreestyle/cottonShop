@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>

        <div class="row mb-3">
            <div class="col-12 text-left">
                <x-admin.form.action-button url="{{route($PrefixRoute.'.Sort')}}" type="sort" :tip="false"/>
            </div>
        </div>


        <x-admin.card.def :page-data="$pageData">

            @if(count($rowData)>0)
                <div class="card-body table-responsive p-0">
                    <table {!!Table_Style($viewDataTable,$yajraTable) !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th>H1</th>
                            <th>H1</th>

                            @if($pageData['ViewType'] == 'deleteList')
                                <x-admin.table.soft-delete/>
                            @else
                                <th></th>
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="delete"/>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->translate('ar')->h1 ?? null}}</td>
                                <td>{{$row->translate('en')->h1 ?? null }}</td>

                                @if($pageData['ViewType'] == 'deleteList')
                                    <x-admin.table.soft-delete type="b" :row="$row"/>
                                @else
                                    <td class="tc">{!! is_active($row->is_active) !!}</td>
                                    <x-admin.table.action-but type="edit" :row="$row"/>
                                    <x-admin.table.action-but type="delete" :row="$row"/>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-admin.hmtl.alert-massage type="nodata"/>
            @endif
        </x-admin.card.def>
        <x-admin.hmtl.pages-link :row="$rowData"/>

    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable"/>
@endpush
