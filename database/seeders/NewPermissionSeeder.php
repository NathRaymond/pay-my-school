<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;

class NewPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'view-user',
            'update-user',
            'delete-user',
            'view-loan',
            'view-grant',
            'disapprove-loan',
            'disapprove-grant',
            'create-role',
            'view-role',
            'update-role',
            'delete-role',
            'view-approval_level',
            'create-approval_level',
            'update-approval_level',
            'delete-approval_level'


        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'sanctum']);
        }
    }
}
