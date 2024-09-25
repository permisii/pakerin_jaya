<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    /**
     * Get the user's full name.
     */
    public function accessMenus(): HasMany {
        return $this->hasMany(AccessMenu::class);
    }

    public function hasPermission($permissionType, $menuCode) {
        // Get the user's access to this menu based on the menu code
        $accessMenu = $this->accessMenus()->whereHas('menu', function ($query) use ($menuCode) {
            $query->where('code', $menuCode);
        })->first();

        if (!$accessMenu) {
            return false; // No access to this menu
        }

        // Check for specific permission (create, read, update, delete)
        return match ($permissionType) {
            'create' => $accessMenu->can_create,
            'read' => $accessMenu->can_read,
            'update' => $accessMenu->can_update,
            'delete' => $accessMenu->can_delete,
            'etc' => $accessMenu->can_etc,
            default => false,
        };
    }
}
