<?php

namespace App\Http\Requests\StoreRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreTenderQuestionRequest extends FormRequest
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
            'tender_id' => ['required', 'exists:tenders,id'],
            'author_company_id' => ['required', 'exists:companies,id'],
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
            'answered_at' => ['required', 'date'],
        ];
    }
}
