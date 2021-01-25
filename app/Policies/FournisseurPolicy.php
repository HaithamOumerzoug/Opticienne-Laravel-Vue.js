<?php

namespace App\Policies;

use App\Fournisseur;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FournisseurPolicy
{
    use HandlesAuthorization;
    public function before($user){
        if($user->is_admin)return true;
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Fournisseur  $fournisseur
     * @return mixed
     */
    public function view(User $user, Fournisseur $fournisseur)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Fournisseur  $fournisseur
     * @return mixed
     */
    public function update(User $user, Fournisseur $fournisseur)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Fournisseur  $fournisseur
     * @return mixed
     */
    public function delete(User $user, Fournisseur $fournisseur)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Fournisseur  $fournisseur
     * @return mixed
     */
    public function restore(User $user, Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Fournisseur  $fournisseur
     * @return mixed
     */
    public function forceDelete(User $user, Fournisseur $fournisseur)
    {
        return false;
    }
}
