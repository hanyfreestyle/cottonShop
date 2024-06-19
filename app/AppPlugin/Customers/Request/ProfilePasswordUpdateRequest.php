<?php

namespace App\AppPlugin\Customers\Request;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePasswordUpdateRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'old_password' => "required|min:8",
            'password' => "required|min:8|confirmed",
        ];

    }

    public function messages() {
        return [

        ];
    }
}
