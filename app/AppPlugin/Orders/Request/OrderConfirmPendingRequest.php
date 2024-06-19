<?php

namespace App\AppPlugin\Orders\Request;

use Illuminate\Foundation\Http\FormRequest;

class OrderConfirmPendingRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(): array {
        return [
            'order_status' => 'required',
            'notes' => 'required_if:order_status,==,2',
            'invoice_number' => "nullable|numeric|min_digits:3",
        ];
    }

    public function messages() {
        return [
            'notes.required_if' => __('admin/orders.from_order_status_2_err_mass'),
        ];
    }


}
