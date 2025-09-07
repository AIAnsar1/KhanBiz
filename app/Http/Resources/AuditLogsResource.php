<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuditLogsResource extends JsonResource
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
            'action'          => $this->action,
            'subject_type'    => $this->subject_type,
            'subject_id'      => $this->subject_id,
            'meta'            => $this->meta,
            'created_at'      => $this->created_at,
            'actor_user'      => new UserResource($this->whenLoaded('actorUser')),
            'actor_company'   => new CompaniesResource($this->whenLoaded('actorCompany')),
        ];
    }
}
