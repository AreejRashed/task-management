<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Donor;
use Illuminate\Auth\Access\HandlesAuthorization;

class DonorPolicy
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
        return $authUser->hasPermissionTo('Read-Doners')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Donor $donor)
    {
        
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($authUser)
    {
        return $authUser->hasPermissionTo('Create-Doner')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($authUser, Donor $donor)
    {
        return $authUser->hasPermissionTo('Update-Doner')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($authUser, Donor $donor)
    {
        return $authUser->hasPermissionTo('Delete-Doner')
        ? $this->allow() : $this->deny('You have no permission for this action');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Donor $donor)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Donor $donor)
    {
        //
    }
}
