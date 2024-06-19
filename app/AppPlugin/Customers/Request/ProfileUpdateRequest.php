<?php

namespace App\AppPlugin\Customers\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        $id = Auth::guard('customer')->user()->id;

        return [
            'name' => "required|min:4|max:50",
            'email' => "required|email|unique:users_customers,email,$id",
            'whatsapp' => "nullable|numeric|min_digits:11",
            'city_id' => "required",
        ];

    }
    public function messages() {
        return [
            'email.unique' => __('web/profileMass.reg_email_unique'),
            'phone.min_digits' => __('web/profileMass.login_phone_err'),
            'phone.max_digits' => __('web/profileMass.login_phone_err'),
        ];
    }

}
