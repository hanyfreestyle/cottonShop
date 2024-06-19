<?php

namespace App\View\Components\Temp\Products;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DescriptionTab extends Component {

    public $product;
    public $additional;
    public $warranty;
    public $shipping;
    public $reviews;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $product = array(),
        $additional = true,
        $warranty = true,
        $shipping = true,
        $reviews = true,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->product = $product;
        $this->additional = $additional;
        $this->warranty = $warranty;
        $this->shipping = $shipping;
        $this->reviews = $reviews;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.temp.products.description-tab');
    }
}
