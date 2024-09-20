<?php

namespace App\Models;

use App\Support\Enums\AssignmentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model {
    use HasFactory;

    protected $fillable = [
        'work_instruction_id',
        'assignment_number',
        'problem',
        'resolution',
        'material',
        'description',
        'status',
        'percentage',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array {
        return [
            'status' => AssignmentStatusEnum::class,
        ];
    }

    public function workInstruction() {
        return $this->belongsTo(WorkInstruction::class);
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
