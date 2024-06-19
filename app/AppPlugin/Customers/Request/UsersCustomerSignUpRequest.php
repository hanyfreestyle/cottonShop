<?php

namespace App\AppPlugin\Customers\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UsersCustomerSignUpRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {

        $countryCode = strtoupper($request->input('countryCode_phone'));

        return [
            'name' => "required|min:4|max:50",
            'phone' => "required|numeric|unique:users_customers|phone:mobile,$countryCode",
            'email' => "nullable|email|unique:users_customers",
            'password' => "required|min:8|confirmed",
            // 'reg_terms'=> "accepted",
        ];

    }

    public function messages() {
        return [
            'email.unique' => __('web/profileMass.reg_email_unique'),
            'phone.unique' => __('web/profileMass.reg_phone_unique'),
            'phone.min_digits' => __('web/profileMass.login_phone_err'),
            'phone.max_digits' => __('web/profileMass.login_phone_err'),
            'reg_terms' => __('web/profileMass.reg_terms'),
        ];
    }

}
