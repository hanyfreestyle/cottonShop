@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="false"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>

        <div class="col-lg-12 dir_button mb-3">
            <x-admin.form.action-button url="{{route($PrefixRoute.'.create')}}" type="add" :tip="false"/>
        </div>

        <x-admin.card.normal :title="__('admin/orders.shipping_box')">
            @if(count($rowData)>0)
                <div class="card-body table-responsive p-0">
                    <table {!! Table_Style(false,false)  !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">{{ __('admin/orders.shipping_name') }}</th>
                            <th class="TD_250">{{ __('admin/orders.shipping_city') }}</th>
                            <th class="TD_20">{{ __('admin/orders.shipping_state') }}</th>
                            <x-admin.table.action-but po="top" type="edit"/>
                            <x-admin.table.action-but po="top" type="edit"/>
                            <x-admin.table.action-but po="top" type="delete"/>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>
                                    @foreach($cashCityList->whereIn('id',json_decode($row->city_id,true)) as $city)
                                        <span class="cat_table_name">{{ $city->name}}</span>
                                    @endforeach
                                </td>
                                <td>{!! is_active($row->is_active) !!}</td>
                                <x-admin.table.action-but type="edit" :row="$row"/>

                                <td class="td_action">
                                    <x-admin.form.action-button url="{{route($PrefixRoute.'.ratesIndex',$row->id)}}" icon="fas fa-search"/>
                                </td>
                                <x-admin.table.action-but type="delete" :row="$row"/>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-admin.hmtl.alert-massage type="nodata"/>
            @endif
        </x-admin.card.normal>
    </x-admin.hmtl.section>


@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins :jscode="true" :is-active="false"/>
@endpush

