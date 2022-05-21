<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Scope;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScopePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($authUser)
    {
        return $authUser->hasPermissionTo('Read-Scopes')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Scope  $scope
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Scope $scope)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($authUser)
    {
        return $authUser->hasPermissionTo('Create-Scope')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Scope  $scope
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($authUser, Scope $scope)
    {
        return $authUser->hasPermissionTo('Update-Scope')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Scope  $scope
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($authUser, Scope $scope)
    {
        return $authUser->hasPermissionTo('Delete-Scope')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Scope  $scope
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Scope $scope)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Scope  $scope
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Scope $scope)
    {
        //
    }
}
