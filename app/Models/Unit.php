<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'unit_code',
        'head_of_unit_id',
        'updated_by',
        'created_by',
    ];

    public function headOfUnit(): BelongsTo {
        return $this->belongsTo(User::class, 'head_of_unit_id');
    }

    /**
     * Get the users for the unit.
     */
    public function users(): HasMany {
        return $this->hasMany(User::class);
    }
}
