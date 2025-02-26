<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'password' => Hash::make('admin123'), // Mã hoá password
            'gender' => 'male',
            'phone' => '0123456789',
            'image' => null,
            'status' => 1,
        ]);
    }
}
