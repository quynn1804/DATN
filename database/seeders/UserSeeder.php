<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'quyn34053@gmail.com'], // Kiểm tra nếu email này đã tồn tại
            [
                'name' => 'Admin',
                'password' => Hash::make('123456'),
                'role_id' => 1, // Admin
                'gender' => 'Nam',
                'phone' => '0123456789',
                'status' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user1@example.com'],
            [
                'name' => 'User 1',
                'password' => Hash::make('123456'),
                'role_id' => 2, // User
                'gender' => 'Nữ',
                'phone' => '0987654321',
                'status' => true,
            ]
        );
        User::updateOrCreate(
            ['email' => 'user2@example.com'],
            [
                'name' => 'User 2',
                'password' => Hash::make('123456'),
                'role_id' => 2, // User
                'gender' => 'Nam',
                'phone' => '0345678922',
                'status' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user3@example.com'],
            [
                'name' => 'User 3',
                'password' => Hash::make('123456'),
                'role_id' => 2, // User
                'gender' => 'Nam',
                'phone' => '0345678912',
                'status' => true,
            ]
        );

    }
}
