<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OPResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'department' => $this->department,
            'code' => $this->code,
            'no' => $this->no,
            'date' => $this->date,
            'first_requestor' => $this->first_requestor,
            'second_requestor' => $this->second_requestor,
            'approved_by' => $this->approved_by,
            'head_of_section_id' => $this->head_of_section_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ];
    }
}
