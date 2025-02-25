<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Capacity;

class CapacitySeeder extends Seeder {
    public function run() {
        Capacity::insert([
            ['name' => '64GB'],
            ['name' => '128GB'],
            ['name' => '256GB'],
        ]);
    }
}
