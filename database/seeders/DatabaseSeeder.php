<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // UserSeeder::class,
            // RoleSeeder::class,
            PermissionSeeder::class,
        ]);

        $permissions = Permission::pluck('id', 'id')->all();

        $role = Role::create(['name' => 'admin','display_name' => 'Admin', 'guard_name' => 'api',]);
        $role->syncPermissions($permissions);

        $user =  User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '1111111111',
            'password' => bcrypt('12345678'),
            'country' => 'India',
            'state' => 'Gujarat',
            'accept_privacy' => '1',
            'isactive' => '1',
        ]);
        
        $user->assignRole([$role->id]);
        
        $role = Role::create(['name' => 'user','display_name' => 'User', 'guard_name' => 'api',]);
        $role->syncPermissions($permissions);

        $user =  User::create([
            'first_name' => 'user1',
            'last_name' => 'user1',
            'email' => 'user1@gmail.com',
            'phone_number' => '1234567891',
            'password' => bcrypt('12345678'),
            'country' => 'India',
            'state' => 'Gujarat',
            'accept_privacy' => '1',
            'isactive' => '1',
        ]);
        $user->assignRole([$role->id]);
        $user =  User::create([
            'first_name' => 'user2',
            'last_name' => 'user2',
            'email' => 'user2@gmail.com',
            'phone_number' => '1234567892',
            'password' => bcrypt('12345678'),
            'country' => 'India',
            'state' => 'Gujarat',
            'accept_privacy' => '1',
            'isactive' => '1',
        ]);
        $user->assignRole([$role->id]);

       
    }
}
