<?php

namespace App\Http\Requests\UpdateRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageRequest extends FormRequest
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
            'thread_type' => ['required', 'string', 'in:direct,tender,chat,bid'],
            'thread_id'   => ['required', 'integer'],
            'from_company_id' => ['required', 'exists:companies,id'],
            'from_user_id' => ['required', 'exists:users,id'],
            'body' => ['required', 'string'],
        ];
    }
}
