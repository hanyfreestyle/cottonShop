@if($type == 1)
  <div class="form-group">
    <input class="" name="{{$name}}[]" value="{{$row->id}}" @if(in_array($row->id,$get)) checked @endif type="checkbox">
    <label class="">{{$row->name}} ({{$row->products_count}})</label>
  </div>
@elseif($type == '2')
  <div class="form-group">
    <input class="" name="{{$name}}[]" value="{{ $id }}" @if(in_array($id,$get)) checked @endif type="checkbox">
    <label class="">{{$label}} ({{ $count }})</label>
  </div>
@elseif($type == '3')

  @foreach($row as $price)
    <div class="form-group">
      <input class="rang_price" name="{{$name}}" value="{{$price['id']}}" @if(in_array($price['id'],$get)) checked @endif type="checkbox" onclick="onlyOne(this)" >
      @if($price['to'])
        <label class="rangnumber">{{$price['from']}} {!! __('web/product.label_currency_s') !!} : {{$price['to']}} {!! __('web/product.label_currency_s') !!}</label>
      @else
        <label class="rangnumber"> <span>{{__('web/product.label_currency_more_than')}}</span> {{$price['from']}} {!! __('web/product.label_currency_s') !!}</label>
      @endif
    </div>
  @endforeach
  <h5 class="widget-title mt_10">{{__('web/filter.title_price_between')}}</h5>
  <div class="form-group row">
    <div class="col">
      <input type="number" class="between_price" name="between[from]" value="{{issetArr($_GET,'from',null)}}" class="form-control" placeholder="{{__('web/filter.title_price_min')}}">
    </div>
    <div class="col">
      <input type="number" class="between_price" name="between[to]" value="{{issetArr($_GET,'to',null)}}" class="form-control" placeholder="{{__('web/filter.title_price_min')}}">
    </div>
  </div>

@endif

@push('ScriptCode')
  <script>
      $( document ).ready(function() {
          $('input[class="between_price"]').on('input',function(e){
              $('input[class="rang_price"]').each(function(index,item){
                  item.checked = false
              });
          });
      });

      function onlyOne(checkbox) {
          var thisName = checkbox.name;
          //  alert(thisName);
          // console.log(checkbox.name)
          var checkboxes = document.getElementsByName(thisName)
          checkboxes.forEach((item) => {
              if (item !== checkbox) item.checked = false
          });

          $('input[class="between_price"]').each(function(index,item){
              $(item).val("");
          });
      }
  </script>
@endpush