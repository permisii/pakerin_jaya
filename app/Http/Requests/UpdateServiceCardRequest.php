<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceCardRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            //            'assignment_id' => 'nullable|integer|exists:assignments,id',
            'assignment_number' => 'nullable|string', // for creating a new assignment
            'date' => 'nullable|date',
            'worker_ids' => 'nullable|array',
            'worker_ids.*' => 'nullable|integer|exists:users,id',
            'description' => 'nullable|string',
            'device_type' => 'nullable|string',
            'device_id' => 'nullable|integer',
            'created_by' => 'nullable|integer|exists:users,id',
            'updated_by' => 'nullable|integer|exists:users,id',
        ];
    }
}
