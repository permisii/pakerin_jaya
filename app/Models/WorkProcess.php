<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class WorkProcess extends Pivot {
    use HasFactory;

    protected $fillable = [
        'service_card_id',
        'user_id',
    ];

    public function serviceCard(): BelongsTo {
        return $this->belongsTo(ServiceCard::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
