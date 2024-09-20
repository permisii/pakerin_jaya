<?php

namespace App\Http\Requests\WorkInstruction;

use App\Rules\WorkInstruction\StoreWorkInstructionRequestUniqueDate;
use App\Support\Enums\WorkInstructionStatusEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreWorkInstructionRequest extends FormRequest {
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'work_date' => ['required', 'date', 'date_format:Y-m-d', 'before_or_equal:today',
                new StoreWorkInstructionRequestUniqueDate($this->user_id),
            ],
            'status' => ['nullable', 'string', 'in:' . implode(',', WorkInstructionStatusEnum::toArray())],
        ];
    }
}
