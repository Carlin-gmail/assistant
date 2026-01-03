<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Let middleware/auth handle authorization
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'bag_number' => 'required|exists:customers,account_number',
            'customer_id' => 'required|exists:customers,id',
            'subcategory' => 'nullable|string',
            'notes'       => 'nullable|string',
        ];
    }
}
