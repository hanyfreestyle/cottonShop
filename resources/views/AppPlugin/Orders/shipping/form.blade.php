@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post">
        @csrf
        <x-admin.hmtl.section>
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        <x-admin.card.normal col="col-lg-12" title="{{__('admin/proProduct.web_city_card')}}">
                            <div class="row mb-3">
                                @if($errors->has([]))
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger alert-dismissible">
                                            {{__('admin/alertMass.form_has_error')}}
                                        </div>
                                    </div>
                                @endif

                                <x-admin.form.input :row="$rowData" name="name" :label="__('admin/orders.shipping_name')" col="12" tdir="ar"/>

                                <x-admin.form.select-multiple name="city_id" label="{{__('admin/orders.shipping_city')}}"
                                                              :categories="$CityList"
                                                              :sel-cat="old('city_id',json_decode($rowData->city_id,true))"
                                                              :req="false" col="12"/>
                            </div>
                            <div class="row mb-3">
                                <x-admin.form.check-active name="is_active" :lable="__('admin/orders.shipping_state')"
                                                           :row="$rowData"
                                                           :page-view="$pageData['ViewType']"/>
                            </div>
                        </x-admin.card.normal>
                    </div>
                </div>

            </div>
            <div class="mb-5">
                <x-admin.form.submit-role-back :page-data="$pageData"/>
            </div>

        </x-admin.hmtl.section>
    </form>

@endsection
