<div class="{{$col}} col-6 this_product_card {{$proStyle['cardStyleRow']}}">
  <div class="product-inner pr">
    <div class="product-image position-relative oh lazyload">
      {!! $productInfo['onsale'] !!}

      <a class="d-block" href="{{route('ProductView',$product->slug)}}">
        <div class="pr_lazy_img main-img nt_img_ratio nt_bg_lz lazyload padding-top__127_571" data-bgset="{{getPhotoPath($product->photo_thum_1,"product","photo")}}"></div>
      </a>

      @if(issetArr($WebConfig,"wish_list",1))
        @if($removeFrom == 'card')
          <livewire:site.favorite-icon :product="$product" :key="$product->id"/>
        @elseif($removeFrom == 'favPage')
          <div class="pa ts__03 favicons nt_add_w">
            <a href="#" wire:click="removeCard({{$product->id}})" class="trash_icon"><i class="facl"></i></a>
          </div>
        @endif
      @endif


      <div class="hover_button op__0 tc pa flex column ts__03">
        @if($quickView and issetArr($WebConfig,"pro_quick_view",1))
          <a href="#" class="pr nt_add_qv cd br__40 pl__25 pr__25 bgw tc dib ttip_nt tooltip_top_left" data-toggle="modal" data-target="#ModalQuickView-{{$product->id}}">
            <span class="tt_txt">{{__('web/product.but_quick_view')}}</span>
            <i class="iccl iccl-eye"></i><span>{{__('web/product.but_quick_view')}}</span>
          </a>
        @endif
        @if($quickShop and issetArr($WebConfig,"pro_quick_shop",1))
          @if(count($product->attributes) == 0)
              <livewire:site.cart.pro-card-add-to-cart :product="$product" :key="$product->id" />
          @else
            <a class="pr pr_atc cd br__40 bgw tc dib cb chp ttip_nt tooltip_top_left" data-toggle="modal" data-target="#ModalQuickShop-{{$product->id}}">
              <span class="tt_txt">{{__('web/product.but_quick_shop')}}</span>
              <i class="iccl iccl-cart"></i><span>{{__('web/product.but_quick_shop')}}</span>
            </a>
          @endif

        @endif
      </div>


    </div>

    <div class="product_info">
      <h3 class="{{$proStyle['cardNameCrop']}}"><a class="cdX chpX" href="{{route('ProductView',$product->slug)}}">{{$product->name}}</a></h3>
      {!! $productInfo['price'] !!}
    </div>

  </div>
</div>

@if($quickView and issetArr($WebConfig,"pro_quick_view",1))
  <x-temp.model.quick-view :product="$product" :product-info="$productInfo"/>
@endif
@if($quickShop and issetArr($WebConfig,"pro_quick_shop",1))
  @if(count($product->attributes) > 0)
    <x-temp.model.quick-shop :product="$product" :product-info="$productInfo"/>
  @endif
@endif


{!! $printSchema->Product($product,"ProductView") !!}
