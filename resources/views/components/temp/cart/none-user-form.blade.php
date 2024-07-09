<x-site.html.confirm-massage/>
<form  id="formSaveOrder" action="{{route('Shop_NoneUserOrderSave')}}" method="post" class="myForm mb__10">
    @csrf
    <input type="text" id="shipping" name="shipping" value="" >
    <input type="hidden" id="customer_id" name="customer_id" value="{{Auth::guard('customer')->user()->id ?? ''}}" >

    <div class="form-row">
        <x-site.form.input name="name" label="{!! __('web/profile.form_recipient_name') !!}" :value="old('name',$address->recipient_name ?? '')" col="8"/>
        <x-site.form.select name="city_id" :send-arr="$cashCityList" :label="__('web/profile.form_city')" :sendvalue="old('city_id',$address->city_id ?? '')" col="4"/>
    </div>

    <div class="form-row">
        <x-site.form.phone name="phone"  :label="__('web/profile.form_mobile')" col="6" :value="old('phone',$address->phone ?? '')"/>
        <x-site.form.input name="phone_option" :label="__('web/profile.form_phone_option')" col="6" :req="false" :value="old('phone_option',$address->phone_option ?? '')"/>
    </div>

    <div class="form-row">
        <x-site.form.text-area name="address" :label="__('web/profile.form_address')" col="12" :value="old('address',$address->address ?? '')"/>
    </div>

    <div class="form-row mt__20">
        <div class="col text_left_lang">
            <button class="btn def_but" id="SaveOrder" type="submit">{{__('web/cart.but_confirm')}}</button>
        </div>
    </div>
</form>
