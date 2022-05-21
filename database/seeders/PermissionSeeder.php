<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //************************ADMIN PERMISSIONS ************************
        // Permission::create(['name' => 'Create-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Project', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Projects', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Project', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Project', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Doner', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Doners', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Doner', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Doner', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Category', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Categories', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Category', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Category', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Scope', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Scopes', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Scope', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Scope', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Users', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-USer', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Register-User', 'guard_name' => 'admin']);









        


          //************************USER PERMISSIONS ************************
        // Permission::create(['name' => 'Create-', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'user']);


        Permission::create(['name' => 'Create-Project', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-Projects', 'guard_name' => 'user']);
        Permission::create(['name' => 'Update-Project', 'guard_name' => 'user']);
        Permission::create(['name' => 'Delete-Project', 'guard_name' => 'user']);

        Permission::create(['name' => 'Create-Doner', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-Doners', 'guard_name' => 'user']);
        Permission::create(['name' => 'Update-Doner', 'guard_name' => 'user']);
        Permission::create(['name' => 'Delete-Doner', 'guard_name' => 'user']);

        
        Permission::create(['name' => 'Create-Category', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-Categories', 'guard_name' => 'user']);
        Permission::create(['name' => 'Update-Category', 'guard_name' => 'user']);
        Permission::create(['name' => 'Delete-Category', 'guard_name' => 'user']);

        Permission::create(['name' => 'Create-Scope', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-Scopes', 'guard_name' => 'user']);
        Permission::create(['name' => 'Update-Scope', 'guard_name' => 'user']);
        Permission::create(['name' => 'Delete-Scope', 'guard_name' => 'user']);

        Permission::create(['name' => 'Create-User', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-Users', 'guard_name' => 'user']);
        Permission::create(['name' => 'Update-User', 'guard_name' => 'user']);
        Permission::create(['name' => 'Delete-USer', 'guard_name' => 'user']);
        Permission::create(['name' => 'Register-User', 'guard_name' => 'user']);


    }
}
