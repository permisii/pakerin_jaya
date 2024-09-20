<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest {
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
            'unit_id' => ['required', 'integer', 'exists:units,id'],
            'nip' => ['required', 'numeric', 'unique:users,nip'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'active' => ['required', 'boolean'],
            //            'updated_by' => ['required', 'integer', 'exists:users,id'],
            //            'created_by' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
