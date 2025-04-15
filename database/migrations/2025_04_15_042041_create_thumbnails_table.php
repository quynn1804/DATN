<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('thumbnails', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // đường dẫn ảnh thumbnail
            $table->nullableMorphs('thumbnailable'); // tạo cột thumbnailable_id & thumbnailable_type (kiểu nó sẽ phân biệt ảnh của sp đơn thể và sp có nhiều biến thểthể)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thumbnails');
    }
};
