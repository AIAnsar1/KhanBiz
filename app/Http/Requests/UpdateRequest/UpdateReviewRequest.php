<?php

namespace App\Http\Requests\UpdateRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            'from_company_id' => ['required', 'exists:companies,id'],
            'to_company_id' => ['required', 'exists:companies,id'],
            'tender_id' => ['required', 'exists:tenders,id'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string'],
        ];
    }
}
