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
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign(['product_variant_id']);

            $table->foreign('product_variant_id')
                  ->references('id')
                  ->on('product_variants')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
     public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            // Rollback: xóa foreign key hiện tại
            $table->dropForeign(['product_variant_id']);

            // Thêm lại foreign key như ban đầu (cascade)
            $table->foreign('product_variant_id')
                  ->references('id')
                  ->on('product_variants')
                  ->onDelete('cascade');
        });
    }
};
