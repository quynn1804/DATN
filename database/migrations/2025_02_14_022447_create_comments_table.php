<<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedTinyInteger('rating')->comment('Đánh giá từ 1 đến 5');
            $table->text('content');
            $table->timestamps();

            // Đảm bảo một người chỉ có thể bình luận một lần cho mỗi sản phẩm trong một đơn hàng
            $table->unique(['order_id', 'product_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}

