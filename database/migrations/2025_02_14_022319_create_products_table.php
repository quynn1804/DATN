<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('color_id')->nullable();     // Chỉ dùng cho sản phẩm đơn
            $table->unsignedBigInteger('capacity_id')->nullable();  // Chỉ dùng cho sản phẩm đơn
            $table->string('name');
            $table->decimal('price', 10, 2)->nullable();            // Chỉ dùng cho sản phẩm đơn
            $table->text('description')->nullable();
            $table->json('images')->nullable();                     // Hỗ trợ nhiều ảnh
            $table->integer('quantity')->nullable();                // Chỉ dùng cho sản phẩm đơn
            $table->enum('product_type', ['single', 'variant'])->default('single');
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null');
            $table->foreign('capacity_id')->references('id')->on('capacities')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
