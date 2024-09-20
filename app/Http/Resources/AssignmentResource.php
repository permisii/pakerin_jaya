<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'work_instruction_id' => $this->work_instruction_id,
            'assignment_number' => $this->assignment_number,
            'problem' => $this->problem,
            'resolution' => $this->resolution,
            'material' => $this->material,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'work_instruction' => WorkInstructionResource::make($this->whenLoaded('workInstruction')),
            'created_by' => UserResource::make($this->whenLoaded('createdBy')),
            'updated_by' => UserResource::make($this->whenLoaded('updatedBy')),
        ];
    }
}
