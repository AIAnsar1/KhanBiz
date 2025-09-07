<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'id'                  => $this->id,
            'amount'              => $this->amount,
            'currency'            => $this->currency,
            'status'              => $this->status,
            'provider'            => $this->provider,
            'provider_invoice_id' => $this->provider_invoice_id,
            'paid_at'             => $this->paid_at,
            'created_at'          => $this->created_at,
            'company'             => new CompaniesResource($this->whenLoaded('company')),
            'plan'                => new PlanResource($this->whenLoaded('plan')),
            'payments'            => PaymentResource::collection($this->whenLoaded('payments')),
        ];
    }
}
