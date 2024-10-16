<?php

namespace App\Policies;

use App\Models\ServiceCard;
use App\Models\User;

class ServiceCardPolicy {
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ServiceCard $serviceCard): bool {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ServiceCard $serviceCard): bool {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ServiceCard $serviceCard): bool {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ServiceCard $serviceCard): bool {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ServiceCard $serviceCard): bool {
        //
    }
}
