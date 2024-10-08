<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model {
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'url',
        'icon',
        'order',
        'created_by',
        'updated_by',
    ];

    public function accessMenus(): HasMany {
        return $this->hasMany(AccessMenu::class);
    }
}
