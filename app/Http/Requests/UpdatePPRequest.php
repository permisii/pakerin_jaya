<?php

namespace App\Http\Requests;

use App\Support\Enums\PPStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePPRequest extends FormRequest {
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
            'item_name' => ['nullable', 'string'],
            'remaining' => ['nullable', 'integer'],
            'need' => ['nullable', 'integer'],
            'buy' => ['nullable', 'integer'],
            'unit' => ['nullable', 'string'],
            'need_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:' . implode(',', PPStatusEnum::toArray())],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'updated_by' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
