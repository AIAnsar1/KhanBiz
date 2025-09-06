<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'id'              => $this->id,
            'rating'          => $this->rating,
            'comment'         => $this->comment,
            'created_at'      => $this->created_at,
            'from_company'    => new CompaniesResource($this->whenLoaded('fromCompany')),
            'to_company'      => new CompaniesResource($this->whenLoaded('toCompany')),
            'tender'          => new TendersResource($this->whenLoaded('tender')),
        ];
    }
}
