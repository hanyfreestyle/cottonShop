<?php

namespace App\AppPlugin\CustomersAdmin\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CustomerStoreRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {
        $id = $this->route('id');

        $rules = [
            'name' => "required|min:4|max:50",
            'city_id' => "required",
        ];

        if(intval($id) == 0) {
            $rules += [
                'phone' => "required|numeric|unique:users_customers",
                'email' => "nullable|email|unique:users_customers",
            ];
        } else {
            $rules += [
                'phone' => "required|numeric|unique:users_customers,phone,$id",
                'email' => "nullable|email|unique:users_customers,email,$id",
            ];
        }
        return $rules;

    }

    public function messages() {
        return [
            'email.unique' => __('web/profileMass.reg_email_unique'),
            'phone.unique' => __('web/profileMass.reg_phone_unique'),
            'phone.min_digits' => __('web/profileMass.login_phone_err'),
            'phone.max_digits' => __('web/profileMass.login_phone_err'),
        ];
    }

}
