<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Capacity;
use Illuminate\Support\Facades\DB;

class CapacitySeeder extends Seeder {
    public function run() {
        DB::table('capacities')->insert([
            ['name' => '64GB'],
            ['name' => '128GB'],
            ['name' => '256GB'],
            ['name' => '512GB'],
        ]);
    }
}
