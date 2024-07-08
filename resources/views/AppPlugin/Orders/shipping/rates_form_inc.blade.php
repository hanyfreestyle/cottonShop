<form class="mainForm" action="{{route($PrefixRoute.'.updateRates',intval($rateId))}}" method="post">
    @csrf
    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <x-admin.card.normal col="col-lg-12" :title="$title">
                        <input type="hidden" name="cat_id" value="{{$cat_id}}">
                        <div class="row mb-4">
                            @if($errors->has([]))
                                <div class="col-lg-12">
                                    <div class="alert alert-danger alert-dismissible">
                                        {{__('admin/alertMass.form_has_error')}}
                                    </div>
                                </div>
                            @endif
                            <x-admin.form.input :row="$rowData" name="price_from" :label="__('admin/orders.shipping_price_form')" col="4" tdir="en"/>
                            <x-admin.form.input :row="$rowData" name="price_to" :label="__('admin/orders.shipping_price_to')" col="4" tdir="en"/>
                            <x-admin.form.input :row="$rowData" name="rate" :label="__('admin/orders.shipping_price_rate')" col="4" tdir="en"/>
                        </div>

                        <x-admin.form.submit :text="$ptype"/>
                    </x-admin.card.normal>
                </div>
            </div>

        </div>
    </x-admin.hmtl.section>
</form>


