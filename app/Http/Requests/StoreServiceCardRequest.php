<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceCardRequest extends FormRequest {
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
            //            'assignment_id' => 'required|integer|exists:assignments,id',
            'assignment_number' => 'required|string', // Required for creating a new assignment
            'date' => 'required|date',
            'worker_ids' => 'required|array',
            'worker_ids.*' => 'required|integer|exists:users,id',
            'description' => 'required|string',
            'device_type' => 'required|string',
            'device_id' => 'required|integer',
            'created_by' => 'required|integer|exists:users,id',
            'updated_by' => 'required|integer|exists:users,id',
        ];
    }
}
