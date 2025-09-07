<?php

namespace App\Http\Requests\UpdateRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuditLogsRequest extends FormRequest
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
            'actor_user_id' => ['required', 'exists:users,id'],
            'actor_company_id' => ['required', 'exists:companies,id'],
            'action' => ['required', 'string', 'max:64'],
            'subject_type' => ['required', 'string', 'max:32'],
            'subject_id' => ['required', 'integer'],
            'meta' => ['required', 'array'],
        ];
    }
}
