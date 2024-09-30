<?php

namespace App\AppPlugin\Customers\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ShoppingOrderSaveNoneUserRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {

        $countryCode = strtoupper($request->input('countryCode_phone'));

        return [
            'shipping' => "required|numeric",
            'name' => "required|regex:/^\S+\s+\S+$/",
            'city_id' => "required",
            'phone' => "numeric|phone:mobile,$countryCode",
            'phone_option' => "nullable|numeric|min_digits:7",
            'address' => "required|min:10|max:250",
        ];
    }

    public function messages() {
        return [
            'phone_option.min_digits' => __('web/profileMass.login_phone_err'),
            'phone_option.max_digits' => __('web/profileMass.login_phone_err'),
            'phone.min_digits' => __('web/profileMass.login_phone_err'),
            'phone.max_digits' => __('web/profileMass.login_phone_err'),
            'name.regex' => "الرجاء إدخال الاسم الأول والاسم الثاني",
        ];

    }

}
