<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'user:view-any']);
        Permission::create(['name' => 'user:create']);
        Permission::create(['name' => 'user:edit']);
        Permission::create(['name' => 'user:delete']);
        Permission::create(['name' => 'user:delete-any']);

        // create roles and assign existing permissions
        $viewerRole = Role::create(['name' => 'viewer']);
        $viewerRole->givePermissionTo('user:view-any');

        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());
    }
}
