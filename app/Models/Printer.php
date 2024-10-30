<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Printer extends Model {
    use HasFactory;

    protected $fillable = [
        'user_name',
        'brand',
        'date_of_initial_use',
        'index',
        'section',
        'type',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date_of_initial_use' => 'date',
    ];

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function serviceCards(): MorphMany {
        return $this->morphMany(ServiceCard::class, 'device');
    }
}
