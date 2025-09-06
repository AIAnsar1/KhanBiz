<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
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
            'id'        => $this->id,
            'code'      => $this->code,
            'title'     => $this->title,
            'price'     => $this->price,
            'currency'  => $this->currency,
            'bid_limit' => $this->bid_limit,
            'features'  => $this->features,
            'active'    => $this->active,
            'subscriptions' => SubscriptionResource::collection($this->whenLoaded('subscriptions')),
        ];
    }
}
