<?php

namespace App\AppPlugin\Orders\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ShippingRequest  extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {

        $id = $this->route('id');

        $rules = [
            'test' => "nullable",
        ];

        $rules += [
            'name' => "required",
            'city_id' => "required|array|min:1",
        ];


        return $rules;
    }


}
