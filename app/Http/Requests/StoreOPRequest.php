<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOPRequest extends FormRequest {
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
            'pp_ids' => 'required|array',
            'pp_ids.*' => 'required|integer|exists:pps,id',
            'department' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'no' => 'required|string|max:255', // automatically generated
            'date_needed_select' => ['required', Rule::in(['2_bulan', 'urgent', 'custom_date'])],
            'custom_date' => [
                'nullable',
                'date',
                Rule::requiredIf($this->input('date_needed_select') === 'custom_date'),
            ],
            'first_requestor' => 'required|string|max:255',
            'second_requestor' => 'required|string|max:255',
            'approved_by' => 'required|string|max:255',
            'head_of_section_id' => 'required|integer|exists:users,id',
            'created_by' => 'required|integer|exists:users,id',
            'updated_by' => 'required|integer|exists:users,id',
        ];
    }
}
