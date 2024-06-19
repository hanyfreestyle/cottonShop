<?php

namespace App\AppPlugin\Customers\Request;

use Illuminate\Foundation\Http\FormRequest;

class UsersCustomersRequest extends FormRequest {

    protected $redirectRoute = "Customer_login";

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {


        return [
            'phone' => "required|numeric|min_digits:11|max_digits:11|exists:users_customers",
            'password' => "required|min:8",
        ];
    }

    public function messages() {
        return [
            'phone.exists' => __('web/profileMass.login_err_exists'),
            'phone.min_digits' => __('web/profileMass.login_phone_err'),
            'phone.max_digits' => __('web/profileMass.login_phone_err'),
        ];
    }

    public function redirect()
    {
        return redirect()->route('login');
    }
}
