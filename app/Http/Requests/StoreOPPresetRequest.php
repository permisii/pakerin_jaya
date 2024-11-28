<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOPPresetRequest extends FormRequest {
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
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            //            'no' => 'required|string|max:255',
            //            'date-needed' => 'required|string|max:255',
            'first_requestor' => 'required|string|max:255',
            'second_requestor' => 'required|string|max:255',
            'approved_by' => 'required|string|max:255',
            'head_of_section_id' => 'required|integer|exists:users,id',
            'created_by' => 'required|integer|exists:users,id',
            'updated_by' => 'required|integer|exists:users,id',
        ];
    }
}
