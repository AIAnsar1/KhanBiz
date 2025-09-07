<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubScriptionResource extends JsonResource
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
            'id'             => $this->id,
            'starts_at'      => $this->starts_at,
            'ends_at'        => $this->ends_at,
            'remaining_bids' => $this->remaining_bids,
            'status'         => $this->status,
            'company'        => new CompaniesResource($this->whenLoaded('company')),
            'plan'           => new PlanResource($this->whenLoaded('plan')),
        ];
    }
}
