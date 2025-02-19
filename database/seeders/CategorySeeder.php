<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Iphone',
                'is_active' => 1,
            ],
            [
                'name' => 'Laptop',
                'is_active' => 1,
            ],
            [
                'name' => 'SamSung',
                'is_active' => 1,
            ],
            [
                'name' => 'OPPO',
                'is_active' => 1,
            ],
            [
                'name' => 'Vsmart',
                'is_active' => 1,
            ],
        ]);
    }
}
