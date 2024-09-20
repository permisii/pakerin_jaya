<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'unit_id',
        'nip',
        'name',
        'email',
        'password',
        'active',
        'updated_by',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the unit that owns the user.
     */
    public function unit(): BelongsTo {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Get the user that owns the user.
     */
    public function updatedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the user that owns the user.
     */
    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by');
    }
}
