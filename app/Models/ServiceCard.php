<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ServiceCard extends Model {
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'date',
        'description',
        'device_type',
        'device_id',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'date' => 'datetime',
    ];

    public function assignment(): BelongsTo {
        return $this->belongsTo(Assignment::class);
    }

    public function workProcesses(): HasMany {
        return $this->hasMany(WorkProcess::class);
    }

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function device(): MorphTo {
        return $this->morphTo();
    }
}
