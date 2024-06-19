<div class="card card_address">
    <div class="card-header">
        <h3>
            {{$address->name}}
            @if($page_type == 'profile')
                @if($address->is_default == true)
                    <span>{{__('web/profile.address_is_default')}}</span>
                @else
                    <form action="{{route('Profile_Address_UpdateDefault',$address->uuid)}}" method="post">
                        @csrf
                        <button class="btn btn_not" type="submit">
                            {{__('web/profile.address_is_default_set')}}
                        </button>
                    </form>
                @endif
            @endif
        </h3>
    </div>

    <div class="card-body">

        <p class="AddressLabelInfo">
            <span>{!! __('web/profile.form_recipient_name') !!} :</span>
            {{$address->recipient_name}}
        </p>

        <p class="AddressLabelInfo">
            <span>{!! __('web/profile.form_city') !!} :</span>
            {{$address->city->name ?? ''}}
        </p>

        <p class="AddressLabelInfo">
            <span>{!! __('web/profile.form_mobile') !!} :</span>
            {{$address->phone}}
        </p>

        @if($address->phone_option)
            <p class="AddressLabelInfo">
                <span>{!! __('web/profile.form_phone_option') !!} :</span>
                {{$address->phone_option}}
            </p>
        @endif

        <p class="AddressLabelInfo print_address">
            <span>{!!__('web/profile.form_address')!!} :</span>
            <br>
            {{($address->address)}}
        </p>

        @if($page_type == 'profile')
            <p class="text_left_lang">
                <a href="{{route('Profile_Address_Edit',$address->uuid)}}" class="btn btn-sm btn-dark">{{__('web/profile.address_edit')}}</a>
            </p>
        @endif

    </div>
</div>
