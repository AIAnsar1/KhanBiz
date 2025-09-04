<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenderBidsResource extends JsonResource
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
            'amount' => $this->amount,
            'currency' => $this->currency,
            'message' => $this->message,
            'status' => $this->status,
            'tenders' => new TendersResource($this->whenLoaded('tender')),
            'supplier_company' => new CompaniesResource($this->whenLoaded('supplierCompany')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
