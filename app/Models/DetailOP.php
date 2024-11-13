<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DetailOP extends Pivot {
    protected $table = 'detail_ops';
    protected $fillable = [
        'op_id',
        'pp_id',
    ];

    public function op(): BelongsTo {
        return $this->belongsTo(OP::class, 'op_id');
    }

    public function pp(): BelongsTo {
        return $this->belongsTo(PP::class, 'pp_id');
    }
}
