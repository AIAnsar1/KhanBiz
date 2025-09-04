<?php

namespace App\Http\Requests\StoreRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreTendersRequest extends FormRequest
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
            'status' => ['required', 'in:draft,pending,published,closed,cancelled'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'budget_amount' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['required', 'in:USD,UZS,KZT,KGS,TJS,TMT'],
            'bids_deadline' => ['nullable', 'date'],
            'published_at' => ['nullable', 'date'],
            'closed_at' => ['nullable', 'date'],
            'visibility' => ['in:public,invited'],
            'company_id' => ['required', 'exists:companies,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'location_id' => ['required', 'exists:locations,id'],
        ];
    }
}
