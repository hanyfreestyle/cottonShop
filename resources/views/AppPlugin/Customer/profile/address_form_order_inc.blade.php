<div class="card profile_card">

  <div class="card-header">
    <h3><i class="las la-map-signs"></i> {{__('web/profile.address_add_new')}}</h3>
  </div>

  <div class="card-body">

    <x-site.html.confirm-massage/>

    <form action="{{route('Profile_Address_Save')}}" method="post" class="myForm mb__10">
      @csrf
      <input type="hidden" name="page_type" value="{{$pageType}}">

      <div class="form-row">
        <x-site.form.input name="recipient_name" label="{!! __('web/profile.form_recipient_name') !!}"
                           :value="old('recipient_name',$UserProfile->name ?? '' )" col="8"/>

        <x-site.form.select name="city_id" :send-arr="$cashCityList" :label="__('web/profile.form_city')"
                            :sendvalue="old('city_id',$UserProfile->city_id  ?? '')" col="4"/>
      </div>


      <div class="form-row">
        <x-site.form.phone name="phone" :label="__('web/profile.form_mobile')" col="6" :value="old('phone',$UserProfile->phone  ?? '')"/>

        <x-site.form.input name="phone_option" :label="__('web/profile.form_phone_option')" col="6" :value="old('phone_option')"/>

      </div>

      <div class="form-row">
        <x-site.form.text-area name="address" :label="__('web/profile.form_address')" col="12" :value="old('address')" />
      </div>

      <div class="form-row mt__20">
        <div class="col text_left_lang">
          <button class="btn def_but" type="submit">{{__('web/profile.address_add_new')}}</button>
        </div>
      </div>

    </form>
  </div>
</div>