<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@p11.test',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Editor',
            'email' => 'editor@p11.test',
            'password' => Hash::make('password123'),
            'role' => 'editor',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@p11.test',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}