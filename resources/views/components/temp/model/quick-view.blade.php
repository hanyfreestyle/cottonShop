<div class="modal fade bd-example-modal-lg" id="ModalQuickView-{{$product->id}}" wire:ignore.self tabindex="-1"
     role="dialog" aria-labelledby="ModalQuickView{{$product->id}}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content quick_view_modal">
      <button type="button" class="model_close" data-dismiss="modal" aria-label="Close">&times;</button>
      <div class="container-fluid cardBody ">

        <div class="row this_quick_view">

          <div class="col-lg-6 text-center">
            <div class="pro_photo_div">
              <a href="{{route('ProductView',$product->slug)}}">
                <img src="{{getPhotoPath($product->photo,"product","photo")}}" alt="{{$product->name}}">
              </a>

              {!! $productInfo['onsale'] !!}
            </div>

            <div class="social_div mt__20 d-none d-lg-block">
              <x-temp.social-share :row="$product" share-type="QuickPro"/>
            </div>

          </div>

          <div class="col-lg-6">
            <div class="kalles-section-pr_summary kalles-section summary entry-summary">
              <h1 class="product_title entry-title fs__16">
                <a href="{{route('ProductView',$product->slug)}}">{{$product->name}}</a>
              </h1>

              <livewire:site.cart.add-to-cart-but :product="$product" :key="$product->id" :product-info="$productInfo"/>


              <x-temp.products.product-meta :product="$product"/>

              <div class="text-center mt__30">
                <a href="{{route('ProductView',$product->slug)}}" class="btn fwsb detail_link p-0 fs__14">{{__('web/product.but_view_full_details')}}</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>