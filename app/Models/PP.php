<?php

namespace App\Models;

use App\Support\Enums\PPStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PP extends Model {
    use HasFactory;

    protected $table = 'pps';
    protected $fillable = [
        'id',
        'item_name',
        'need',
        'unit',
        'need_date',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'need_date' => 'date',
        'status' => PPStatusEnum::class,
    ];

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
