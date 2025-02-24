<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Admin', 'action_level' => 'high']);
        Role::create(['name' => 'users', 'action_level' => 'basic']);
    }
}
