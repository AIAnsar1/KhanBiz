<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenderQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        parent::toArray($request);
        
        return [
            'id' => $this->id,
            'question' => $this->question,
            'answer' => $this->answer,
            'answered_at' => $this->answered_at,
            'tender' => new TendersResource($this->whenLoaded('tender')),
            'author_company' => new CompaniesResource($this->whenLoaded('authorCompany')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
