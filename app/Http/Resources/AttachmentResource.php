<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
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
            'disk'      => $this->disk,
            'path'      => $this->path,
            'mime'      => $this->mime,
            'size'      => $this->size,
            'created_at'=> $this->created_at,
        ];
    }
}
