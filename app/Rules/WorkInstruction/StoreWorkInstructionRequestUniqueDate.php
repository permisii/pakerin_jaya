<?php

namespace App\Rules\WorkInstruction;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class StoreWorkInstructionRequestUniqueDate implements ValidationRule {
    protected $userId;

    public function __construct($userId) {
        $this->userId = $userId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string = null): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        $exists = DB::table('work_instructions')
            ->where('user_id', $this->userId)
            ->where('work_date', $value)
            ->exists();

        if ($exists) {
            $fail('The work date has already been taken for this user.');
        }
    }
}
