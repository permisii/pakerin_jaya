<?php

namespace App\Http\Requests\Assignment;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssignmentRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            //            'work_instruction_id' => 'required|exists:work_instructions,id',
            'assignment_number' => 'required|string',
            'problem' => 'required|string',
            'resolution' => 'nullable|string',
            'material' => 'nullable|string',
            'description' => 'nullable|string',
            // 'status' => 'nullable|string', // automatically handled by percentage
            'percentage' => 'nullable|integer|min:0|max:100',
            'created_by' => 'nullable|exists:users,id',
            'updated_by' => 'nullable|exists:users,id',
        ];
    }
}
