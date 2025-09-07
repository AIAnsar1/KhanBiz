<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'id'                   => $this->id,
            'amount'               => $this->amount,
            'currency'             => $this->currency,
            'status'               => $this->status,
            'provider'             => $this->provider,
            'provider_payment_id'  => $this->provider_payment_id,
            'created_at'           => $this->created_at,
            'invoice'              => new InvoiceResource($this->whenLoaded('invoice')),
        ];
    }
}
