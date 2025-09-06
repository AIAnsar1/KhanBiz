<?php

namespace App\Http\Requests\StoreRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
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
            'reporter_company_id' => ['required', 'exists:companies,id'],
            'target_type' => ['required', 'in:tender,bid,company,message'],
            'target_id' => ['required', 'integer'],
            'reason' => ['required', 'string'],
            'status' => ['required', 'in:open,review,resolved,rejected'],
        ];
    }
}
