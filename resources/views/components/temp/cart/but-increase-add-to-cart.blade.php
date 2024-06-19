<div class="mini_cart_actions main" wire:loading.remove>
  <div class="quantity pr qty__true">
    <input type="number" class="input-text qty text tc qty_cart_jsX" step="1" min="1" disabled
           max="5"
           value="{{$cart->where('id', $productId)->first()->qty}}">
    <div class="qty tc fs__14">
      <button type="button" wire:click="increaseProduct({{$productId}})"
              class="plus db cb pa pd__0 pr__15 tr r__0"><i class="facl facl-plus"></i></button>
      @if($cart->where('id', $productId)->first()->qty == 1)
        <button type="button" wire:click="removeFromCart({{$productId}})"
                class="db cb pa pd__0 pl__15 tl l__0 qty_1"><i class="facl facl-minus"></i>
        </button>
      @else
        <button type="button" wire:click="decreaseProduct({{$productId}})"
                class="minus db cb pa pd__0 pl__15 tl l__0 qty_1"><i
           class="facl facl-minus"></i>
        </button>
      @endif
    </div>
  </div>
</div>

@if($fromCard)
  <div class="mini_cart_actions dn mobile" wire:loading.remove>
    <div class="quantity prX qty__trueX">
      <input type="number" class="input-text qty text tc" step="1" min="1" disabled
             max="5"
             value="{{$cart->where('id', $productId)->first()->qty}}">
      <div class="qty tc fs__14">
        <button type="button" wire:click="increaseProduct({{$productId}})"
                class="plus db cb pa pd__0 pr__15 tr r__0"><i class="facl facl-plus"></i></button>
        @if($cart->where('id', $productId)->first()->qty == 1)
          <button type="button" wire:click="removeFromCart({{$productId}})"
                  class="db cb pa pd__0 pl__15 tl l__0 qty_1"><i class="facl facl-minus"></i>
          </button>
        @else
          <button type="button" wire:click="decreaseProduct({{$productId}})"
                  class="minus db cb pa pd__0 pl__15 tl l__0 qty_1"><i
             class="facl facl-minus"></i>
          </button>
        @endif
      </div>
    </div>
  </div>
@endif
