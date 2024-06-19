<div class="col-lg-2 col-6  mb__10 pb__10">
  <div class="row SearchCard">
    <div class="col-lg-12 col-6x">
      <div class="fix_search_img">
        <a  href="{{route('ProductView',$product->slug)}}">
          <img src="{{getPhotoPath($product->photo_thum_1,"product","photo")}}"
               class="w__100 lz_op_ef lazyload" alt data-bgset="{{getPhotoPath($product->photo_thum_1,"product","photo")}}">
        </a>
      </div>
    </div>
    <div class="col-lg-12 col-6x mt__5">
      <a class="crop_line_1 pro_name" href="{{route('ProductView',$product->slug)}}">{{$product->name}}</a>
      {!! $productInfo['price'] !!}
    </div>
  </div>
</div>