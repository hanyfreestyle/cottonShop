@if($isactive)
  <div class="col-12 col-md-12 widget widget_product_list">
    <h5 class="headline__title">{{__('web/blog.side_sale_products')}}</h5>
    <div class="product_list_widget">
      @foreach($products as $product)
        <div class="row mb__10 pb__10">
          <div class="col widget_img_ar_new">
            <a class="db pr oh" href="{{route('ProductView',$product->slug)}}">
              <img src="{{getPhotoPath($product->photo_thum_1,"product","photo_thum_1")}}" class="w__100 lz_op_ef lazyload" alt="{{$product->name}}"
                   data-srcset="{{getPhotoPath($product->photo_thum_1,"product","photo_thum_1")}}">
            </a>
          </div>
          <div class="col widget_if_pr this_quick_shop">
            <a class="product-title db " href="{{route('ProductView',$product->slug)}}">{{$product->name}}</a>
            @if($product->regular_price)
              <div class="mb__5 print_price">
                <div class="del"><span>{{__('web/product.label_currency')}}</span>{{number_format($product->regular_price, 0)}}</div>
                <div class="ins"><span>{{__('web/product.label_currency')}}</span>{{number_format($product->price, 0)}}</div>
              </div>
            @else
              <div class="mb__5 print_price">
                <div class="ins"><span>{{__('web/product.label_currency')}}</span>{{number_format($product->price, 0)}}</div>
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif