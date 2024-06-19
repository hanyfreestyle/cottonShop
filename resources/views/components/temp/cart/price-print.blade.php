<div class="product_info">
  @if($regularPrice)
    <div class="mb__5 print_price">
      <div class="del"><span>{{__('web/product.label_currency')}}</span>{{number_format($regularPrice, 0)}}</div>
      <div class="ins"><span>{{__('web/product.label_currency')}}</span>{{number_format($price, 0)}}</div>
    </div>
  @else
    <div class="mb__5 print_price">
      <div class="ins"><span>{{__('web/product.label_currency')}}</span>{{number_format($price, 0)}}</div>
    </div>
  @endif
</div>
