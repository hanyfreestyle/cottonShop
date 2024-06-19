<?php

namespace App\View\Components\Temp\Tools;


use App\AppPlugin\Product\Helpers\FilterBuilder;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class CheckBox extends Component {

    public $row;
    public $name;
    public $get;
    public $type;
    public $label;
    public $count;
    public $id;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $name = null,
        $get = array(),
        $type = 1,
        $label = null,
        $count = null,
        $id = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->row = $row;
        $this->name = $name;

        if(isset($_GET[$name])){
            $getval = FilterBuilder::cleanText($_GET[$name]);
            if(is_array($getval) and count($getval) >0 ){
                $this->get = $getval ;
            }else{
                $this->get = [] ;
            }
        }else{
            $this->get = $get;
        }

        $this->type = $type;
        $this->label = $label;
        $this->count = $count;
        $this->id = $id;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.temp.tools.check-box');
    }
}
