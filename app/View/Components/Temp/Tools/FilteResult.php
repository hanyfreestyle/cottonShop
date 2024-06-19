<?php

namespace App\View\Components\Temp\Tools;

use App\AppPlugin\Product\Helpers\FilterBuilder;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilteResult extends Component {

    public $products;
    public $brandArr;
    public $categoryArr;
    public $option_2;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $products = array(),
        $brandArr = array(),
        $categoryArr = array(),
        $option_2 = null,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->products = $products;

        $this->brandArr = $brandArr;
        if(isset($_GET['brand'])) {
            $brandId = FilterBuilder::cleanText($_GET['brand']);
            if(is_array($brandId) and count($brandId) > 0) {
                $this->brandArr = $brandId;
            }
        }

        $this->categoryArr = $categoryArr;
        if(isset($_GET['category'])) {
            $categoryId = FilterBuilder::cleanText($_GET['category']);
            if(is_array($categoryId) and count($categoryId) > 0) {
                $this->categoryArr = $categoryId;
            }
        }



        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.temp.tools.filte-result');
    }
}
