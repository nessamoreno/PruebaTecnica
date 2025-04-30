<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Cambiar a true para permitir la actualización
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
            'document_number' => 'required|unique:companies,document_number,' . $this->route('company') . '|max:255',            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'address'         => 'required|string|max:255',
            'phone'           => 'nullable|string|max:20',
            'mobile'          => 'nullable|string|max:20',
            'email'           => 'required|email|unique:companies,email,' . $this->route('company'),
            'user'            => 'required|string|max:255',
        ];
    }
}
