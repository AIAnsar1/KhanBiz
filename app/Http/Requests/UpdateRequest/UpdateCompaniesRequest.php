<?php

namespace App\Http\Requests\UpdateRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompaniesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'legal_name' => ['required', 'string', 'max:255'],
            'brand_name' => ['required', 'string', 'max:255'],
            'tin' => ['required', 'string', 'max:64'],
            'country_code' => ['required', 'string', 'size:2'],
            'city' => ['required', 'string', 'max:120'],
            'address' => ['required', 'string'],
            'website' => ['required', 'string', 'max:255', 'url'],
            'verified_at' => ['required', 'date'],
            'about' => ['required', 'array'],
        ];
    }
}
