@extends('web.layouts.app')
@section('content')
  <div id="nt_content" style="min-height: 600px;" class="mt__100 mb__100">
    <div class="container mb__50">

      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <img id="product_img" src="{{getPhotoPath($product->photo,"product","photo")}}" class="card-img-top" style="height:250px;">
            <div class="card-body">
              <h5 class="card-title">{{$product->name}}</h5>
              {{--              <p class="card-text">{{$product->g_des}}</p>--}}

              <p id="product_price" class="font-weight-bold">${{$product->price}}</p>
              <p id="product_regular_price" class="font-weight-bold">${{$product->regular_price}}</p>
              <input id="product_id" type="hidden" value="{{$product->id}}">
            </div>
          </div>
        </div>
        <div class="col-lg-8">

          @foreach ($product->attributes as $attribute)
            <h3>{{ucfirst($attribute->name)}}</h3>
{{--            <div class="d-flex">--}}
              @foreach ($values->whereIn('id',json_decode($attribute->pivot->values, true)) as $value)

                <label class="d-flex mr-3">
                  <input class="attribute_action mr-1" name="{{$attribute->name}}" type="radio" value="{{$value->id}}">
                  <span>{{ucfirst($value->name)}}</span>
                </label>
              @endforeach
{{--            </div>--}}
          @endforeach

        </div>
      </div>


    </div>
  </div>



  {{--  <div id="nt_content" style="min-height: 600px;" class="mt__100 mb__100">--}}
  {{--    <div class="container mb__50">--}}
  {{--      <div class="row fl_wrap fl_wrap_md oah use_border_false pr-2 pl-2">--}}
  {{--        {{$product->name}}<br>--}}
  {{--        @foreach($product->attributes as $attribute)--}}
  {{--          {{$attribute->name}}<br>--}}
  {{--          @foreach($values->whereIn('id',json_decode($attribute->pivot->values, true)) as $val)--}}
  {{--            {{$val->name}} <br>--}}
  {{--          @endforeach--}}
  {{--        @endforeach--}}
  {{--      </div>--}}
  {{--    </div>--}}
  {{--  </div>--}}

@endsection


@push('ScriptCode')
  <script>
      $('.attribute_action').click(function(){
          var variants = [];

          $('.attribute_action:checked').each(function(i){
              variants.push($(this).val());
          });
          var data = {
              product_id:$('#product_id').val(),
              variants,
          }


          $.ajax({
              type: "GET",
              url:"{{route('ProductViewID', $product->id)}}",
              data:data,
              success: function (res) {
                  console.log(res);
                  if(res.status){
                      $('#product_img').attr('src', res.image);
                      $('#product_price').html(res.price);
                      $('#product_regular_price').html(res.regular_price);
                  }
              }
          });

      });
  </script>
@endpush
