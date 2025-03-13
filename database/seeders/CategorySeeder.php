<?php
namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'OPPO', 'is_active' => 1]);
        Category::create(['name' => 'IPHONE', 'is_active' => 1]);
        Category::create(['name' => 'SAMSUNG', 'is_active' => 1]);
        Category::create(['name' => 'HUAWEI', 'is_active' => 1]);
    }
}
