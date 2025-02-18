<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Color;


class ColorSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu cho bảng color
        DB::table('colors')->insert([
            ['name' => 'Đỏ'],
            ['name' => 'Xanh'],
            ['name' => 'Đen'],
            ['name' => 'Trắng'],
        ]);
    }
}
