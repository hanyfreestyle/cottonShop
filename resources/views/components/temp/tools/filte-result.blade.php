@if(isset($_GET['filter']))
  <div class="result_clear mt__10">
    @if($products->total())
      <div class="sp_result_html dib cb clear_filter"><span class="cp">{{$products->total()}}</span> {{__('web/filter.result_products')}}</div>
    @endif

    @csrf
    <input type="hidden" id="url" name="url" dir="ltr" value="{{Request::Url()}}">
    <input type="hidden" id="url_filter" name="url_filter" dir="ltr" value="{{serialize(Request::all())}}">

    <a href="#" class="clear_filter dib" id="clearAll">{{__('web/filter.but_filter_clear')}}</a>

    @if(isset($_GET['rang']))
      @foreach($priceRang_Arr as $price)
        @if($price['id'] == $_GET['rang'] )
          @if($price['to'])
            <a href="#" class="clear_filter dib bf_icons" id="rang" aria-label="{{$_GET['rang']}}">{{$price['from']}} {!! __('web/product.label_currency_s') !!}
              : {{$price['to']}} {!! __('web/product.label_currency_s') !!}</a>
          @else
            <a href="#" class="clear_filter dib bf_icons" id="rang" aria-label="{{$_GET['rang']}}">
              <span> {{__('web/product.label_currency_more_than')}}</span> {{$price['from']}} {!! __('web/product.label_currency_s') !!}</a>
          @endif
        @endif
      @endforeach
    @endif

    @if(isset($_GET['from']))
      <a href="#" class="clear_filter dib" id="betweenfrom">
        {{__('web/filter.title_price_min')}} {{$_GET['from']}} {!! __('web/product.label_currency_s') !!}
      </a>
    @endif

    @if(isset($_GET['to']))
      <a href="#" class="clear_filter dib" id="betweento">
        {{__('web/filter.title_price_max')}} {{$_GET['to']}} {!! __('web/product.label_currency_s') !!}
      </a>
    @endif

    @if(isset($_GET['brand']) and count($brandArr) > 0)
      @foreach($brandArr as $brand)
        @if($CashBrandMenuList->where('id',$brand)->first()->name)
          <a href="#" class="clear_filter dib" id="brand" data-id="{{$brand}}">{{$CashBrandMenuList->where('id',$brand)->first()->name}}</a>
        @endif
      @endforeach
    @endif

    @if(isset($_GET['category']) and count($categoryArr) > 0)
      @foreach($categoryArr as $category)
        @if(isset($CashCategoryFilterList->where('id',$category)->first()->name))
          <a href="#" class="clear_filter dib" id="category" data-id="{{$category}}">{{$CashCategoryFilterList->where('id',$category)->first()->name}}</a>
        @endif
      @endforeach
    @endif

  </div>
@endif

@push('ScriptCode')
  <script>
      $(document).ready(function () {
          $('.clear_filter').on('click', function (e) {
              var url = $('#url').val();
              var url_filter = $('#url_filter').val();
              var formid = $(this).attr('id');
              var thisid = $(this).attr('data-id');
              // alert(id);
              $.ajax({
                  url: '{{ route('FilterClear')}}',
                  type: 'get',
                  data: {
                      update: 1,
                      formid: formid,
                      url: url,
                      url_filter: url_filter,
                      thisid: thisid,
                  },
                  success: function (response) {
                      // console.log(response.url);
                      window.location.href = response.url;

                  }
              });
          });
      })
  </script>

@endpush
