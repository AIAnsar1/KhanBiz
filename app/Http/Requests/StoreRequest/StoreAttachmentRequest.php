<?php

namespace App\Http\Requests\StoreRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttachmentRequest extends FormRequest
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
            'owner_type' => ['required', 'in:tender,bid,company,message'],
            'owner_id' => ['required', 'integer'],
            'disk' => ['required', 'string', 'max:32'],
            'path' => ['required', 'string'],
            'mime' => ['required', 'string', 'max:128'],
            'size' => ['required', 'integer'],
        ];
    }
}
