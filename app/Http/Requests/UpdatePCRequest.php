<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePCRequest extends FormRequest {
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
//            'user_id' => 'nullable|integer|exists:users,id',
            'user_name' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'date_of_initial_use' => 'nullable|date',
            'index' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'monitor' => 'nullable|string|max:255',
            'vga' => 'nullable|string|max:255',
            'processor' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:255',
            'hdd' => 'nullable|string|max:255',
            'keyboard' => 'nullable|string|max:255',
            'mouse' => 'nullable|string|max:255',
            'created_by' => 'nullable|integer|exists:users,id',
            'updated_by' => 'nullable|integer|exists:users,id',
        ];
    }
}
