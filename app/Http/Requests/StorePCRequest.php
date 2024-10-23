<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePCRequest extends FormRequest {
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
            //            'user_id' => 'required|integer|exists:users,id',
            'user_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'date_of_initial_use' => 'required|date',
            'index' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'monitor' => 'required|string|max:255',
            'vga' => 'required|string|max:255',
            'processor' => 'required|string|max:255',
            'ram' => 'required|string|max:255',
            'hdd' => 'required|string|max:255',
            'keyboard' => 'required|string|max:255',
            'mouse' => 'required|string|max:255',
            'created_by' => 'required|integer|exists:users,id',
            'updated_by' => 'required|integer|exists:users,id',
        ];
    }
}
