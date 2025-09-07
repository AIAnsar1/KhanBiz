<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'thread_type'     => $this->thread_type,
            'thread_id'       => $this->thread_id,
            'body'            => $this->body,
            'created_at'      => $this->created_at,
            'from_company'    => new CompaniesResource($this->whenLoaded('fromCompany')),
            'from_user'       => new UserResource($this->whenLoaded('fromUser')),
            'attachments'     => AttachmentResource::collection($this->whenLoaded('attachments')),
        ];
    }
}
