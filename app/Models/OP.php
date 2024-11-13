<?php

namespace App\Models;

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
        'date',
        'head_of_section_id',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'date' => 'date',
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
}
