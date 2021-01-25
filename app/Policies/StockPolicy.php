<?php

namespace App\Policies;

use App\Stock;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StockPolicy
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
     * @param  \App\Stock  $stock
     * @return mixed
     */
    public function view(User $user, Stock $stock)
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
     * @param  \App\Stock  $stock
     * @return mixed
     */
    public function update(User $user, Stock $stock)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Stock  $stock
     * @return mixed
     */
    public function delete(User $user, Stock $stock)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Stock  $stock
     * @return mixed
     */
    public function restore(User $user, Stock $stock)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Stock  $stock
     * @return mixed
     */
    public function forceDelete(User $user, Stock $stock)
    {
        return false;
    }
}
