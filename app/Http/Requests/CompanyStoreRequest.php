<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'document_type'   => 'required|in:NIT,CC',
            'document_number' => 'required|unique:companies,document_number|max:255',
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'address'         => 'required|string|max:255',
            'phone'           => 'nullable|string|max:20',
            'mobile'          => 'nullable|string|max:20',
            'email'           => 'required|email|unique:companies,email',
            'user'            => 'required|string|max:255',
        ];
    }
}