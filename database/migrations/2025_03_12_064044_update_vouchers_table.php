<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration {
    public function up()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->decimal('min_discount_amount', 10, 2)->change(); // Hỗ trợ số thập phân
            $table->decimal('max_discount_amount', 10, 2)->nullable()->change(); // Nếu cần có mức giảm tối đa
        });
    }

    public function down()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->integer('min_discount_amount')->change(); // Quay lại kiểu cũ nếu rollback
            $table->integer('max_discount_amount')->nullable()->change();
        });
    }
};
