<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest {
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
        $userId = $this->route('user')->id;

        return [
            'unit_id' => ['nullable', 'integer', 'exists:units,id'],
            'nip' => ['nullable', 'string', 'max:255', 'unique:users,nip,' . $userId],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,' . $userId],
            'password' => ['nullable', 'string', 'min:8'],
            'active' => ['nullable', 'boolean'],
            //            'updated_by' => ['nullable', 'integer', 'exists:users,id'],
            //            'created_by' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
