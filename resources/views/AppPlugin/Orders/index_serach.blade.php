@extends('admin.layouts.app')

@section('StyleFile')

@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12">
                <x-admin.card.normal>
                    <form method="get">
                        <div class="row">
                            <x-admin.form.input name="id" :value="old('id',issetArr($_GET,'id'))" col="3" :labelview="true" :placeholder="false" label="Order Id "/>
                            <x-admin.form.input name="paymob_id" :value="old('paymob_id',issetArr($_GET,'paymob_id'))" col="3" :labelview="true" :placeholder="false" label="Paymob Id "/>
                            <x-admin.form.input name="paymob_order_id" :value="old('paymob_order_id',issetArr($_GET,'paymob_order_id'))" col="3" :labelview="true" :placeholder="false"
                                                label="Paymob Order Id "/>
                        </div>
                        <div class="row formFilterBut">
                            <button type="submit" class="btn btn-dark btn-sm"><i class="fas fa-filter"></i>بحث</button>
                        </div>
                    </form>
                </x-admin.card.normal>
            </div>
        </div>
    </x-admin.hmtl.section>

    @if($requestCount != 0)
        <x-admin.hmtl.section>
            @if(!$order)
                <div class="row">
                    <div class="col-lg-12">
                        <x-admin.hmtl.alert-massage type="nodata"/>
                    </div>
                </div>
            @else
                <div class="row mb-5">
                    <div class="col-lg-12">
                        @include('AppPlugin.Orders.invoce_inc')
                    </div>
                </div>
            @endif
        </x-admin.hmtl.section>
    @endif


@endsection

