<?php

namespace App\Models;

use App\Events\OPCreated;
use App\Helpers\NumberHelper;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class OP extends Model {
    use HasFactory;

    protected $table = 'ops';
    protected $fillable = [
        'id',
        'department',
        'code',
        'no',
        'date_needed',
        'first_requestor',
        'second_requestor',
        'approved_by',
        'head_of_section_id',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        // Datatable compilation error, because this date_needed sometimes NOT a date
        // 'date_needed' => 'datetime',
    ];

    public function headOfSection(): BelongsTo {
        return $this->belongsTo(User::class, 'head_of_section_id');
    }

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function detailOPs(): HasMany {
        return $this->hasMany(DetailOP::class, 'op_id');
    }

    public function pps(): HasManyThrough {
        return $this->hasManyThrough(PP::class, DetailOP::class, 'op_id', 'id', 'id', 'pp_id');
    }

    public function canBeDeleted(): bool {
        return $this->pps()->count() === 0;
    }

    public function getCustomizedNoAttribute() {
        // Get the current year
        $currentYear = now()->year;

        // Count the records for the current year
        $rowPosition = OP::whereYear('date', $currentYear)->count() + 1;

        // Get initial of head of section
        $headOfSectionInitial = $this->headOfSection ? implode('', array_map(function ($word) {
            return substr($word, 0, 1);
        }, explode(' ', $this->headOfSection->name))) : '';

        // Get department
        $department = $this->department;

        // Convert current month to Roman numerals
        $currentMonth = now()->month;
        $romanMonth = NumberHelper::intToRoman($currentMonth);

        // Combine all parts
        return "{$rowPosition}/{$headOfSectionInitial}/{$department}/{$romanMonth}/{$currentYear}";
    }

    public function isValidDate($format = 'Y-m-d'): bool {
        $d = DateTime::createFromFormat($format, $this->date_needed);

        return $d && $d->format($format) === $this->date_needed;
    }

    //    protected static function booted(): void {
    //        static::created(function ($op) {
    //            event(new OPCreated($op));
    //        });
    //    }
}
