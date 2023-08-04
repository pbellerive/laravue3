<?php

namespace App\Users;

use App\Users\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends \App\Policies\BasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Users\Users\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Users\Users\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Users\Users\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Users\Users\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->id == $model->id || $user->hasPermission('can_update_users');
    }

    public function updatePermissions(User $user, User $model)
    {
        return $user->id != $model->id && $user->hasPermission('can_update_permissions_users');
        return $user->id != $model->id && $user->hasPermission('can_update_permissions_users');
    }

    public function updateRoles(User $user, User $model)
    {
        return $user->id != $model->id && $user->hasPermission('can_update_roles_users');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Users\Users\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Users\Users\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Users\Users\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
