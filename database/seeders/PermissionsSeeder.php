<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list applications']);
        Permission::create(['name' => 'view applications']);
        Permission::create(['name' => 'create applications']);
        Permission::create(['name' => 'update applications']);
        Permission::create(['name' => 'delete applications']);

        Permission::create(['name' => 'list awards']);
        Permission::create(['name' => 'view awards']);
        Permission::create(['name' => 'create awards']);
        Permission::create(['name' => 'update awards']);
        Permission::create(['name' => 'delete awards']);

        Permission::create(['name' => 'list directbosses']);
        Permission::create(['name' => 'view directbosses']);
        Permission::create(['name' => 'create directbosses']);
        Permission::create(['name' => 'update directbosses']);
        Permission::create(['name' => 'delete directbosses']);

        Permission::create(['name' => 'list employees']);
        Permission::create(['name' => 'view employees']);
        Permission::create(['name' => 'create employees']);
        Permission::create(['name' => 'update employees']);
        Permission::create(['name' => 'delete employees']);

        Permission::create(['name' => 'list positions']);
        Permission::create(['name' => 'view positions']);
        Permission::create(['name' => 'create positions']);
        Permission::create(['name' => 'update positions']);
        Permission::create(['name' => 'delete positions']);

        Permission::create(['name' => 'list supervisorcommittees']);
        Permission::create(['name' => 'view supervisorcommittees']);
        Permission::create(['name' => 'create supervisorcommittees']);
        Permission::create(['name' => 'update supervisorcommittees']);
        Permission::create(['name' => 'delete supervisorcommittees']);

        Permission::create(['name' => 'list technicalcommittees']);
        Permission::create(['name' => 'view technicalcommittees']);
        Permission::create(['name' => 'create technicalcommittees']);
        Permission::create(['name' => 'update technicalcommittees']);
        Permission::create(['name' => 'delete technicalcommittees']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
