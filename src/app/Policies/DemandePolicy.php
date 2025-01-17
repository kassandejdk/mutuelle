<?php

namespace App\Policies;

use App\Models\Demande;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DemandePolicy
{
    public function before(User $user,string $ability): ?bool
    {
        if ($user->hasRole(4)) return true;
        return null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Demande $demande): bool
    {
        return $user->id === $demande->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Demande $demande): bool
    {
        if( $demande->statut!=='en traitement') return false;
        return $user->id === $demande->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Demande $demande): bool
    {
        if( $demande->statut!=='en traitement') return false;
        return $user->id === $demande->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Demande $demande): bool
    {
        return $user->id === $demande->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Demande $demande): bool
    {
        return $user->id === $demande->user_id;

    }
}
