<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TendersResource extends JsonResource
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
            'status' => $this->status,
            'title' => $this->title,
            'description' => $this->description,
            'budget_amount' => $this->budget_amount,
            'currency' => $this->currency,
            'bids_deadline' => $this->bids_deadline,
            'published_at' => $this->published_at,
            'closed_at' => $this->closed_at,
            'visibility' => $this->visibility,
            'company' => new CompaniesResource($this->whenLoaded('company')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'location' => new LocationResource($this->whenLoaded('location')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
