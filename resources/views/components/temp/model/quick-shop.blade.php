<div class="modal fade bd-example-modal-lg" id="ModalQuickShop-{{$product->id}}" wire:ignore.self tabindex="-1"
     role="dialog" aria-labelledby="ModalQuickShop{{$product->id}}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered quick_shop_modal_w" role="document">
    <div class="modal-content quick_shop_modal">
      <button type="button" class="model_close" data-dismiss="modal" aria-label="Close">&times;</button>
      <div class="container-fluid cardBody ">
        <div class="row this_quick_shop">
          <div class="col-lg-12">

            <div class="row">
              <div class="col-lg-5 col-4">
                <div class="pro_photo_div">
                  <a href="{{route('ProductView',$product->slug)}}">
                    <img src="{{getPhotoPath($product->photo,"product","photo")}}" alt="{{$product->name}}">
                  </a>
                  {!! $productInfo['onsale'] !!}
                </div>
              </div>
              <div class="col-lg-7 col-8">
                <h1 class="product_title entry-title fs__16">
                  <a href="{{route('ProductView',$product->slug)}}">{{$product->name}}</a>
                </h1>
                <livewire:site.cart.add-to-cart-but :product="$product" :key="$product->id" :product-info="$productInfo" :view-des="false"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>