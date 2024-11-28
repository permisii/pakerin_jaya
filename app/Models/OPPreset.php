<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OPPreset extends Model {
    use HasFactory;

    protected $table = 'op_presets';
    protected $fillable = [
        'name',
        'department',
        'code',
        'no',
        //        'date-needed',
        'first_requestor',
        'second_requestor',
        'approved_by',
        'head_of_section_id',
        'updated_by',
        'created_by',
    ];

    public function headOfSection(): BelongsTo {
        return $this->belongsTo(User::class, 'head_of_section_id');
    }
}
