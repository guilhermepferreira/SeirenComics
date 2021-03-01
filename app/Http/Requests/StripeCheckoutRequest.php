<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StripeCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price_id' => 'required|exists:plans,stripe_id'
        ];
    }
}
