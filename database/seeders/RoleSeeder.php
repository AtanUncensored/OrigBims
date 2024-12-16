<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create_barangay']);
        Permission::create(['name' => 'create_user']);

        $role = Role::create(['name' => 'superAdmin']);
        $role->givePermissionTo('create_barangay');

        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('create_user');

        $role2 = Role::create(['name' => 'user']);
        $role2->givePermissionTo();
    }
    
}
