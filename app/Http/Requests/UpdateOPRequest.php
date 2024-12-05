<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOPRequest extends FormRequest {
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
            'pp_ids' => 'nullable|array',
            'pp_ids.*' => 'nullable|integer|exists:pps,id',
            'department' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'no' => 'nullable|string|max:255', // automatically generated
            'date-needed' => 'nullable|string|max:255',
            'first_requestor' => 'nullable|string|max:255',
            'second_requestor' => 'nullable|string|max:255',
            'approved_by' => 'nullable|string|max:255',
            'head_of_section_id' => 'nullable|integer|exists:users,id',
            'created_by' => 'nullable|integer|exists:users,id',
            'updated_by' => 'nullable|integer|exists:users,id',
        ];
    }
}
