@extends('web.layouts.app')
@push('StyleFile')
  {!! (new \App\Helpers\MinifyTools)->MinifyCss('temp/css/shopping-cart.css',"Seo",$cssReBuild) !!}
@endpush

@section('content')
  <div id="nt_content" class="mt__5">
    <x-site.def.breadcrumbs>
      {{ Breadcrumbs::render('Shop',$meta) }}
    </x-site.def.breadcrumbs>

    <div class="kalles-section cart_page_section container mt__20 pb-lg-5 mb__100">
      <div class="frm_cart_page check-out_calculator">
        <div class="row">
          <div class="col-12 col-md-6 col-lg-6 mb__20">
            <x-temp.cart.invoice-table :cart-list="$cartList" :sub-total="$subTotal"/>
          </div>
          <div class="col-12 col-md-6 col-lg-6 mb__100">
            <div class="checkout-section">
              <h3 class="checkout-section__title">{{__('web/cart.review_invoce_form')}}</h3>
              <div class="row">
                <div class="col-lg-12">
                  @if(Auth::guard('customer')->user())
                    @if(count($addresses) == 0 or count($addresses) == 1)
                      <x-temp.cart.none-user-form :address="$addresses->where('is_default',true)->first()"/>
                    @else
                      <div class="form-group mb-3">
                        <div class="custom_select">
                          <select class="form-control address_id" id="address_id" name="address_id" >
                            @foreach($addresses as $address)
                              <option value="{{$address->uuid}}" @if($address->is_default) selected @endif >{{$address->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <x-temp.cart.none-user-form :address="$addresses->where('is_default',true)->first()"/>
                    @endif

                  @else
                    <div class="confrim_login_text">
                      <a href="#" class="push_side" data-id="#nt_login_canvas" >{{__('web/cart.confrim_login_1')}}</a> {{__('web/cart.confrim_login_2')}}
                      <a href="{{route('Customer_Register')}}">{{__('web/cart.confrim_login_3')}}</a>
                    </div>
                    <x-temp.cart.none-user-form/>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('ScriptCode')
  <script type="text/javascript">
      $(document).ready(function () {

          $("#address_id").on("change", function () {
              var address_id = $('#address_id').val();
              // alert(address_id);
              $.ajax({
                  url: '{{route('Shop_AddressUpdate')}}',
                  type: 'get',
                  data: {
                      address_id: address_id,
                  },
                  success: function (res) {
                      $('#name').val(res.data.recipient_name);
                      $('#city_id').val(res.data.city_id);
                      $('#phone').val(res.data.phone);
                      $('#phone_option').val(res.data.phone_option);
                      $('#address').val(res.data.address);
                      console.log(res);

                      var city_id = res.data.city_id;
                      $.ajax({
                          url: '{{route('Shop_ShippingConfirm')}}',
                          type: 'get',
                          data: {
                              update: 1,
                              city_id: city_id,
                          },
                          success: function (res) {
                              $('#shipping').val(res.data.shipping);
                              $('#shippingSpan').html(res.data.shippingSpan);
                              $('#shippingText').html(res.data.shippingText);
                              $('#invoiceTotal').html(res.data.invoiceTotal);
                              console.log(res.data.shipping);
                          }
                      });

                  }
              });
          });

          var city_id = $('#city_id').val();
          $.ajax({
              url: '{{route('Shop_ShippingConfirm')}}',
              type: 'get',
              data: {
                  update: 1,
                  city_id: city_id,
              },
              success: function (res) {
                  $('#shipping').val(res.data.shipping);
                  $('#shippingSpan').html(res.data.shippingSpan);
                  $('#shippingText').html(res.data.shippingText);
                  $('#invoiceTotal').html(res.data.invoiceTotal);
                  console.log(res.data.shipping);
              }
          });

          $("#city_id").on("change", function () {
              var city_id = $('#city_id').val();
              $.ajax({
                  url: '{{route('Shop_ShippingConfirm')}}',
                  type: 'get',
                  data: {
                      update: 1,
                      city_id: city_id,
                  },
                  success: function (res) {
                      $('#shipping').val(res.data.shipping);
                      $('#shippingSpan').html(res.data.shippingSpan);
                      $('#shippingText').html(res.data.shippingText);
                      $('#invoiceTotal').html(res.data.invoiceTotal);
                      console.log(res.data.shipping);
                  }
              });
          });

      });
  </script>
@endpush
