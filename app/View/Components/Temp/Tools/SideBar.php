<?php

namespace App\View\Components\Temp\Tools;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBar extends Component {

    public $row;
    public $brandView;
    public $brandLimit;
    public $subCat;
    public $categoryView;
    public $categoryLimit;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $brandView = true,
        $brandLimit = '10000',
        $subCat = array(),
        $categoryView = true,
        $categoryLimit = "10000",
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->row = $row;
        $this->brandView = $brandView;

        $this->brandLimit = $brandLimit;
        $this->subCat = $subCat;
        $this->categoryView = $categoryView;
        $this->categoryLimit = $categoryLimit;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.temp.tools.side-bar');
    }
}
