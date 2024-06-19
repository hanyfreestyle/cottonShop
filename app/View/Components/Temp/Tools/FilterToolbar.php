<?php

namespace App\View\Components\Temp\Tools;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterToolbar extends Component {

    public $row;
    public $isactive;
    public $sortby;
    public $filterby;
    public $colby;
    public $filterData;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $isactive = true,
        $sortby = true,
        $filterby = true,
        $colby = true,
        $filterData = array(),
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->row = $row;
        $this->isactive = $isactive;
        $this->sortby = $sortby;
        $this->filterby = $filterby;
        $this->colby = $colby;
        $this->filterData = $filterData;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.temp.tools.filter-toolbar');
    }
}
