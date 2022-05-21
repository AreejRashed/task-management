<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
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
        return $authUser->hasPermissionTo('Read-Projects')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($authUser, Project $project)
    {
        return $authUser->hasPermissionTo('Register-User')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($authUser)
    {
        return $authUser->hasPermissionTo('Create-Project')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($authUser, Project $project)
    {
        return $authUser->hasPermissionTo('Update-Project')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($authUser, Project $project)
    {
        return $authUser->hasPermissionTo('Delete-Project')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Project $project)
    {
        //
    }
}
