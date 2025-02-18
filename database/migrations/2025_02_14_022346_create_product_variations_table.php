<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationsTable extends Migration
{
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('type'); // "color" hoặc "storage"
            $table->string('value'); // VD: "Đỏ", "128GB"
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('product_variations');
    }
}
