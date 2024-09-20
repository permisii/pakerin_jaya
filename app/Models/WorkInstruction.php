<?php

namespace App\Models;

use App\Support\Enums\WorkInstructionStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkInstruction extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_date',
        'status',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array {
        return [
            'status' => WorkInstructionStatusEnum::class,
        ];
    }

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
