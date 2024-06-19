<?php

namespace App\View\Components\Temp;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SocialShare extends Component {

    public $row;
    public $links;
    public $facebook;
    public $twitter;
    public $linkedin;
    public $whatsapp;
    public $gmail;
    public $telegram;
    public $pinterest;
    public $shareType;

    public function __construct(
        $row = array(),
        $links = array(),
        $facebook = true,
        $twitter = true,
        $linkedin = true,
        $whatsapp = true,
        $gmail = true,
        $telegram = true,
        $pinterest = true,
        $shareType = "onPage",
    ) {
        $this->row = $row;
        $printName = str_replace(" ", "+", $row->name);

        if($shareType == 'onPage'){
            $PageUrl = \Request::fullUrl();
            $PageUrl = urldecode($PageUrl);
        }elseif($shareType == 'QuickPro'){
            $PageUrl = route('ProductView',$row->slug);
            $PageUrl = urldecode($PageUrl);
        }



//         $PageUrl = "https://stackoverflow.com";

        $this->facebook = $facebook;
        if($this->facebook == true) {
            $links['facebook'] = 'https://www.facebook.com/sharer/sharer.php?u=' . $PageUrl;
        }

        $this->twitter = $twitter;
        if($this->twitter == true) {
            $links['twitter'] = 'https://twitter.com/intent/tweet?text=' . $printName . '&url=' . $PageUrl;
        }

        $this->linkedin = $linkedin;
        if($this->linkedin == true) {
            $links['linkedin'] = 'https://www.linkedin.com/sharing/share-offsite?mini=true&url=' . $PageUrl . '&title=' . $printName;
        }

        $this->whatsapp = $whatsapp;
        if($this->whatsapp == true) {
            $links['whatsapp'] = 'https://wa.me/?text=' . $PageUrl . "%0a" . $printName;
        }

        $this->gmail = $gmail;
        if($this->gmail == true) {
            $links['gmail'] = 'https://mail.google.com/mail/u/0/?to&su=' . $printName . '&body=' . $PageUrl . "/&bcc&cc&fs=1&tf=cm";
        }


        $this->telegram = $telegram;
        if($this->telegram == true) {
            $links['telegram'] = 'https://t.me/share/url?url=' . $PageUrl . '&' . $printName . '&to=';
        }

        $this->pinterest = $pinterest;
        if($this->pinterest == true) {
            $links['pinterest'] = 'https://www.pinterest.com/pin/create/button/?description=' . $printName . '&url=' . $PageUrl;
        }

        $this->links = $links;
    }

    public function render(): View|Closure|string {
        return view('components.temp.social-share');
    }
}
