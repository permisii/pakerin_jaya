<?php

namespace App\Http\Requests;

use App\Support\Enums\PPStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class StorePPRequest extends FormRequest {
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
            'item_name' => ['required', 'string'],
            'remaining' => ['nullable', 'integer'],
            'need' => ['nullable', 'integer'],
            'buy' => ['nullable', 'integer'],
            'unit' => ['required', 'string'],
            'need_date' => ['required', 'date'],
            'description' => ['required', 'string'],
            'status' => ['nullable', 'string', 'in:' . implode(',', PPStatusEnum::toArray())],
            'created_by' => ['required', 'integer', 'exists:users,id'],
            'updated_by' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
