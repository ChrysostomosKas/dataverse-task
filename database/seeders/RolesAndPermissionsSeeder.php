<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        Permission::create(['name' => 'administrate']);
        Permission::create(['name' => 'manage users']);

        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo(Permission::all());

        $simple_user = Role::create(['name' => 'User']);
        $technical_administrator = Role::create(['name' => 'Technical Administrator']);
        $user_manager = Role::create(['name' => 'User manager']);
        $content_manager = Role::create(['name' => 'Content manager']);
        $legislation_manager = Role::create(['name' => 'Legislation Manager']);
    }
}
