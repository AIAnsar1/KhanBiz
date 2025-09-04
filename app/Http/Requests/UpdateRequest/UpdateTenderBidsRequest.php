<?php

namespace App\Http\Requests\UpdateRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTenderBidsRequest extends FormRequest
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
            'amount' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'message' => ['required', 'string'],
            'status' => ['required', 'in:submitted,shortlisted,rejected,winner,withdrawn'],
            'tender_id' => ['required', 'exists:tenders,id'],
            'supplier_company_id' => ['required', 'exists:companies,id'],
        ];
    }
}
