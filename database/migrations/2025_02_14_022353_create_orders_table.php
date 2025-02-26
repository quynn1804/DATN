<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('phone');
            $table->text('address');
            $table->decimal('total_money', 10, 2);
            $table->enum('payment_method', ['cod', 'bank_transfer', 'credit_card', 'paypal', 'MoMo'])->default('cod');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
