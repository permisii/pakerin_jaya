<?php

namespace App\Listeners;

use App\Events\OPCreated;
use App\Helpers\NumberHelper;
use App\Models\OP;

class UpdateOPSequenceNumber {
    /**
     * Create the event listener.
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OPCreated $event): void {
        $op = $event->op;

        // Get the current year
        $currentYear = now()->year;

        // Count the records for the current year
        $rowPosition = OP::whereYear('created_at', $currentYear)->count() + 1;

        // Get initial of head of section
        $headOfSectionInitial = $op->headOfSection ? implode('', array_map(function ($word) {
            return substr($word, 0, 1);
        }, explode(' ', $op->headOfSection->name))) : '';

        // Get department
        $department = $op->department;

        // Convert current month to Roman numerals
        $currentMonth = now()->month;
        $romanMonth = NumberHelper::intToRoman($currentMonth);

        // Combine all parts
        $customizedNo = "{$rowPosition}/{$headOfSectionInitial}/{$department}/{$romanMonth}/{$currentYear}";

        // Update the OP with the customized number
        $op->update(['no' => $customizedNo]);
    }
}
