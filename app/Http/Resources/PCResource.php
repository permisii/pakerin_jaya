<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PCResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'date_of_initial_use' => $this->date_of_initial_use,
            'index' => $this->index,
            'section' => $this->section,
            'monitor' => $this->monitor,
            'vga' => $this->vga,
            'processor' => $this->processor,
            'ram' => $this->ram,
            'hdd' => $this->hdd,
            'keyboard' => $this->keyboard,
            'mouse' => $this->mouse,
            'created_by' => UserResource::make($this->whenLoaded('createdBy')),
            'updated_by' => UserResource::make($this->whenLoaded('updatedBy')),
        ];
    }
}
