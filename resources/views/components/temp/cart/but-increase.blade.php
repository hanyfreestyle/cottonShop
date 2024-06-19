<div class="quantity pr mr__10 qty__true">
    <input type="number" class="input-text qty text tc qty_cart_jsX" step="1" min="1" disabled max="5" value="{{$product->qty}}">
    <div class="qty tc fs__14">
        <button type="button" wire:click="increaseProduct({{$product->id}})" class="plus db cb pa pd__0 pr__15 tr r__0"><i class="facl facl-plus"></i></button>
        @if($product->qty == 1)
            <button type="button" wire:click="removeFromCart({{$product->id}})" class="db cb pa pd__0 pl__15 tl l__0 qty_1"><i class="facl facl-minus"></i></button>
        @else
            <button type="button" wire:click="decreaseProduct({{$product->id}})" class="minus db cb pa pd__0 pl__15 tl l__0 qty_1"><i class="facl facl-minus"></i></button>
        @endif
    </div>
</div>