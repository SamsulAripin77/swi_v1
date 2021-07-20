<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Penjualan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PenjualanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Penjualan  $penjualan
     * @return mixed
     */
    public function view(User $user, Penjualan $penjualan)
    {
        return $user->id === $penjualan->created_by_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Penjualan  $penjualan
     * @return mixed
     */
    public function update(User $user, Penjualan $penjualan)
    {
        return $user->id === $penjualan->created_by_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Penjualan  $penjualan
     * @return mixed
     */
    public function delete(User $user, Penjualan $penjualan)
    {
        return $user->id === $penjualan->created_by_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Penjualan  $penjualan
     * @return mixed
     */
    public function restore(User $user, Penjualan $penjualan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Penjualan  $penjualan
     * @return mixed
     */
    public function forceDelete(User $user, Penjualan $penjualan)
    {
        //
    }
}
