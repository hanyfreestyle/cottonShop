<?php

namespace App\View\Components\Temp\Products;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductSlider extends Component {

    public $product;
    public $thumb;
    public $zoom;
    public $photoPswp;
    public $productInfo;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $product = array(),
        $thumb = false,
        $zoom = false,
        $photoPswp = false,
        $productInfo = array(),
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->product = $product;
        $this->thumb = $thumb;
        if($zoom == true){
            $this->zoom = " img_action_zoom ";
        }else{

            $this->zoom = null;
        }

        $this->photoPswp = $photoPswp;
        $this->productInfo = $productInfo;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.temp.products.product-slider');
    }
}
