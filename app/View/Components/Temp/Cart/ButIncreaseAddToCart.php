<?php

namespace App\View\Components\Temp\Cart;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButIncreaseAddToCart extends Component {

    public $cart;
    public $productId;
    public $fromCard;


    public function __construct(
        $cart = array(),
        $productId = true,
        $fromCard = false,

    ) {
        $this->cart = $cart;
        $this->productId = $productId;
        $this->fromCard = $fromCard;
    }

    public function render(): View|Closure|string {
        return view('components.temp.cart.but-increase-add-to-cart');
    }
}
