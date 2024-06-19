<?php

namespace App\View\Components\Temp\Cart;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NoneUserForm extends Component {

    public $address;


    public function __construct(
        $address = array(),

    ) {
        $this->address = $address;

    }

    public function render(): View|Closure|string {
        return view('components.temp.cart.none-user-form');
    }
}
