<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PC extends Model {
    use HasFactory;

    protected $table = 'pcs';
    protected $fillable = [
        'user_id',
        'name',
        'date_of_initial_use',
        'index',
        'section',
        'monitor',
        'vga',
        'processor',
        'ram',
        'hdd',
        'keyboard',
        'mouse',
        'created_by',
        'updated_by',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

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
