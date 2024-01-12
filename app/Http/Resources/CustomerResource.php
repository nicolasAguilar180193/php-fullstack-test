<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'dni' => $this->dni,
            'address' => $this->address,
            'regions' => $this->region->description,
            'commune' => $this->commune->description
        ];
    }
}
