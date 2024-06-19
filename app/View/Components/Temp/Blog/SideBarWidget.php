<?php

namespace App\View\Components\Temp\Blog;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBarWidget extends Component {

    public $row;
    public $isactive;
    public $categories;
    public $mostRead;
    public $saleProducts;
    public $popularTags;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $isactive = true,
        $categories = true,
        $mostRead = true,
        $saleProducts = true,
        $popularTags = true,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->row = $row;
        $this->isactive = $isactive;
        $this->categories = $categories;
        $this->mostRead = $mostRead;
        $this->saleProducts = $saleProducts;
        $this->popularTags = $popularTags;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.temp.blog.side-bar-widget');
    }
}
