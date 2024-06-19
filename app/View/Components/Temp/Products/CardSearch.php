<?php

namespace App\View\Components\Temp\Products;

use App\AppPlugin\Product\Helpers\LoadProductInfo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardSearch extends Component {

    public $product;
    public $quickView;
    public $quickShop;
    public $removeFrom;
    public $col;
    public $productInfo;

    public function __construct(
        $product = array(),
        $quickView = true,
        $quickShop = true,
        $removeFrom = "card",
        $col = null,

    ) {
        $this->product = $product;


        $this->removeFrom = $removeFrom;

        if($col == null) {
            $this->col = "col-lg-4 col-md-4 ";
        } else {
            $this->col = "col-lg-$col col-md-$col ";
        }

        $LoadProductInfo = new LoadProductInfo();

        $productInfo = $LoadProductInfo->setQuickView($quickView)->setquickShop($quickShop)->getInfo($this->product);
        $this->productInfo = $productInfo;
        $this->quickView = $productInfo['quickView'];
        $this->quickShop = $productInfo['quickShop'];

    }

    public function render(): View|Closure|string {
        return view('components.temp.products.card-search');
    }
}
