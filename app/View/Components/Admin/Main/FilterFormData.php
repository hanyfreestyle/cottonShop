<?php

namespace App\View\Components\Admin\Main;

use App\AppPlugin\Data\City\Models\City;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class FilterFormData extends Component {

    public $row;
    public $formName;
    public $getSessionData;
    public $isActive;
    public $countryId;
    public $continent;
    public $cityId;
    public $cityList;

    public function __construct(
        $row = array(),
        $formName = null,
        $isActive = true,
        $countryId = false,
        $continent = false,
        $cityId = false,
        $cityList = array(),
    ) {
        $this->row = $row;
        $this->formName = $formName;
        $this->getSessionData = Session::get($this->formName);
        $this->isActive = $isActive;
        $this->countryId = $countryId;
        $this->continent = $continent;
        $this->cityId = $cityId;
        if (isset($this->getSessionData['country_id']) and intval($this->getSessionData['country_id']) > 0) {
            $this->cityList = City::where('country_id', intval($this->getSessionData['country_id']))->get();
        } else {
            $this->cityList = $cityList;
        }


    }

    public function render(): View|Closure|string {
        return view('components.admin.main.filter-form-data');
    }
}
