<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CommuneResource;

class RegionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_reg,
            'description' => $this->description,
            'status' => $this->status,
            'communes' => CommuneResource::collection($this->whenLoaded('communes')),
        ];
    }
}
