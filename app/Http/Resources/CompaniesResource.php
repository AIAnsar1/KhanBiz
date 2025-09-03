<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompaniesResource extends JsonResource
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
            'legal_name'   => $this->legal_name,
            'brand_name'   => $this->brand_name,
            'tin'          => $this->tin,
            'country_code' => $this->country_code,
            'city'         => $this->city,
            'address'      => $this->address,
            'website'      => $this->website,
            'verified_at'  => $this->verified_at,
            'about'        => $this->about,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
