<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        User::create([
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
        User::create([
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
    }
}
