<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'id'                 => $this->id,
            'target_type'        => $this->target_type,
            'target_id'          => $this->target_id,
            'reason'             => $this->reason,
            'status'             => $this->status,
            'created_at'         => $this->created_at,
            'reporter_company'   => new CompaniesResource($this->whenLoaded('reporterCompany')),
        ];
    }
}
