<?php

namespace App\AppPlugin\Orders\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ShippingRateRequest  extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {

        $id = $this->route('id');

        $rules = [
            'test' => "nullable",
        ];

        $rules += [
            'price_from' => "required|numeric|min:1",
            'price_to' => "required|numeric|gt:price_from",
            'rate' => "required|numeric",
        ];


        return $rules;
    }


}
