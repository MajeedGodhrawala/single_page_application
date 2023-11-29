<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'view_user',
                'display_name' =>  'View User',
                'category' => 'User',
                'guard_name' => 'api'
            ],
            [
                'name' => 'add_user',
                'display_name' =>  'Add User',
                'category' => 'User',
                'guard_name' => 'api'
            ],
            [
                'name' => 'edit_user',
                'display_name' =>  'Edit User',
                'category' => 'User',
                'guard_name' => 'api'
            ],
            [
                'name' => 'delete_user',
                'display_name' =>  'Delete User',
                'category' => 'User',
                'guard_name' => 'api'
            ],
            [
                'name' => 'view_profile',
                'display_name' =>  'View Profile',
                'category' => 'Profile',
                'guard_name' => 'api'
            ],
            [
                'name' => 'edit_profile',
                'display_name' =>  'Edit Profile',
                'category' => 'Profile',
                'guard_name' => 'api'
            ],
            [
                'name' => 'view_role',
                'display_name' =>  'View Role',
                'category' => 'Role',
                'guard_name' => 'api'
            ],
            [
                'name' => 'add_role',
                'display_name' =>  'Add Role',
                'category' => 'Role',
                'guard_name' => 'api'
            ],
            [
                'name' => 'delete_role',
                'display_name' =>  'delete Role',
                'category' => 'Role',
                'guard_name' => 'api'
            ],
            [
                'name' => 'edit_role',
                'display_name' =>  'Edit Role',
                'category' => 'Role',
                'guard_name' => 'api'
            ],
        ];

        foreach($datas as $data ){
            Permission::create($data);
        }
    }
}
