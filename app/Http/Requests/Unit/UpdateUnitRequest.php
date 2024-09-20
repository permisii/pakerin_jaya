<?php

namespace App\Http\Requests\Unit;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitRequest extends FormRequest {
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
        $unitId = $this->route('unit')->id;

        return [
            'name' => ['nullable', 'string', 'max:255'],
            'unit_code' => ['nullable', 'string', 'max:255', 'unique:units,unit_code,' . $unitId],
        ];
    }
}
