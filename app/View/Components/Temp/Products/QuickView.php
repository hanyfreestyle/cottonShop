<?php

namespace App\View\Components\Temp\Products;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class QuickView extends Component {

    public $product;
    public $proInfo;
    public $addToCart;
    public $option_2;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $product = array(),
        $proInfo = array(),
        $addToCart = true,

        $option_2 = null,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->product = $product;
        $this->proInfo = $proInfo;

        $this->addToCart = $addToCart;
        if($product->on_stock == false){
            $this->addToCart = false;
        }

        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.temp.products.quick-view');
    }
}
