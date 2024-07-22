<?php

namespace App\View\Components\Temp;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class FooterCall extends Component {

    public $callhref;
    public $config;
    public $whatsapphref;
    public $product;


    public function __construct(

        $config = true,
        $whatsapphref = null,
        $product = null,

    ) {
        $this->callhref = "tel:" . $config->phone_call;
        $this->product = $product;


        $Brek = "%0a";
        $GetMass = "";

        if ($this->product != null) {
            $GetMass .= __('web/contact.mass_whatsapp_1') . " " . $this->product->name . $Brek;
            $GetMass .= route('ProductView', $this->product->slug) . $Brek;

        } else {
            $GetMass .= __('web/contact.mass_whatsapp_1') . " " . $Brek;
        }
        $Mass = str_replace(" ", "+", $GetMass);
//        $Mass = str_replace("*","%2A",$Mass);
//        $Mass = str_replace("#","%23",$Mass);
        $Whatsapp_Url = 'https://api.whatsapp.com/send/?phone=' . $config->whatsapp_send . '&text=' . $Mass;
        $this->whatsapphref = $Whatsapp_Url;

    }

    public function render(): View|Closure|string {
        return view('components.temp.footer-call');
    }
}
