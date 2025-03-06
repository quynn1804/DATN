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
                'role_id' => 2, // Admin
                'gender' => 'Nam',
                'phone' => '0123456789',
                'status' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Người dùng',
                'password' => Hash::make('123456'),
                'role_id' => 1, // User
                'gender' => 'Nữ',
                'phone' => '0987654321',
                'status' => true,
            ]
        );
    }
}
