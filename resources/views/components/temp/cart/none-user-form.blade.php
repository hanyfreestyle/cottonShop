<x-site.html.confirm-massage/>
<form id="formSaveOrder" action="{{route('Shop_NoneUserOrderSave')}}" method="post" class="myForm mb__10">
    @csrf
    <input type="hidden" id="shipping" name="shipping" value="">
    <input type="hidden" id="customer_id" name="customer_id" value="{{Auth::guard('customer')->user()->id ?? ''}}">

    <div class="form-row">
        <x-site.form.input name="name" label="{!! __('web/profile.form_recipient_name') !!}" :value="old('name',$address->recipient_name ?? '')" col="8"/>
        <x-site.form.select name="city_id" :send-arr="$cashCityList" :label="__('web/profile.form_city')" :sendvalue="old('city_id',$address->city_id ?? '')" col="4"/>
    </div>

    <div class="form-row">
        <x-site.form.phone name="phone" :label="__('web/profile.form_mobile')" col="6" :value="old('phone',$address->phone ?? '')"/>
        <x-site.form.input name="phone_option" :label="__('web/profile.form_phone_option')" col="6" :req="false" :value="old('phone_option',$address->phone_option ?? '')"/>
    </div>

    <div class="form-row">
        <x-site.form.text-area name="address" :label="__('web/profile.form_address')" col="12" :value="old('address',$address->address ?? '')"/>
    </div>

{{--    <div class="form-row">--}}
{{--        <div class="col">--}}
{{--            <div class="accordion-started accordion-bral">--}}
{{--                <div class="accordion_div">--}}
{{--                    <input class="ac-input" id="ac-1" value="1" name="payment_method" type="radio" @if( old('payment_method',issetArr($_POST,'payment_method',1)) == 1 ) checked @endif />--}}
{{--                    <label class="ac-label" for="ac-1">{{__('web/cart.payment_visa')}}</label>--}}
{{--                    <div class="article ac-content">--}}
{{--                        <p class="text-justify">--}}
{{--                            <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="pay_visa" def-name="photo" alt="404" :lazy-active="false" class="img-fluid"/>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="accordion_div">--}}
{{--                    <input class="ac-input" id="ac-2" value="2" name="payment_method" type="radio" @if( old('payment_method') == 2) checked @endif />--}}
{{--                    <label class="ac-label" for="ac-2">{{__('web/cart.payment_cash')}}</label>--}}
{{--                    <div class="article ac-content">--}}
{{--                        <p class="text-justify">--}}
{{--                            <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="pay_cash" def-name="photo" alt="404" :lazy-active="false" class="img-fluid"/>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <input type="hidden" name="payment_method" value="2">

    <div class="form-row mt__20">
        <div class="col text_left_lang">
            <button class="btn def_but" id="SaveOrder" type="submit">{{__('web/cart.but_confirm')}}</button>
        </div>
    </div>

</form>





