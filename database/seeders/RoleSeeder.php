<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()

    {
        Role::updateOrCreate(
            ['name' => 'Admin'], // Điều kiện kiểm tra trùng
            ['action_level' => 'low']
        );

        Role::updateOrCreate(
            ['name' => 'User'],
            ['action_level' => 'high']
        );

    }
}
