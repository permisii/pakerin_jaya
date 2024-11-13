<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessMenu extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'menu_id',
        'can_create',
        'can_read',
        'can_update',
        'can_delete',
        'can_etc',
        'created_by',
        'updated_by',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function menu(): BelongsTo {
        return $this->belongsTo(Menu::class);
    }
}
