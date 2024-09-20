<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'unit_id' => $this->unit_id,
            'nip' => $this->nip,
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'unit' => new UnitResource($this->whenLoaded('unit')),
            'updated_by' => new UserResource($this->whenLoaded('updatedBy')),
            'created_by' => new UserResource($this->whenLoaded('createdBy')),
        ];
    }
}
