@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    @if(count($rowData->rates) > 0)
        <x-admin.hmtl.section>
            <div class="row">
                <x-admin.card.normal col="col-lg-12">
                    <div class="card-body table-responsive p-0">
                        <table {!! Table_Style(false,false)  !!} >
                            <thead>
                            <tr>
                                <th>{{ __('admin/orders.shipping_price_form') }}</th>
                                <th>{{ __('admin/orders.shipping_price_to') }}</th>
                                <th>{{ __('admin/orders.shipping_price_rate') }}</th>
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="delete"/>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rowData->rates as $rate)
                                <tr>
                                    <td>{{$rate->price_from}}</td>
                                    <td>{{$rate->price_to}}</td>
                                    <td>{{$rate->rate}}</td>
                                    <td class="td_action">
                                        <x-admin.form.action-button url="{{route($PrefixRoute.'.editRates',$rate->id)}}" icon="fas fa-pencil-alt" bg="i"/>
                                    </td>
                                    <td class="td_action">
                                        <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.destroyRates',$rate->id)}}" type="deleteSweet"/>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-admin.card.normal>
            </div>
        </x-admin.hmtl.section>
    @endif

    @include('AppPlugin.Orders.shipping.rates_form_inc',[
    'ptype'=>'Add',
    'cat_id'=>$rowData->id,
    'rateId'=> 0,
    'title'=>__('admin/orders.shipping_reate_add')
    ])


@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
@endpush

