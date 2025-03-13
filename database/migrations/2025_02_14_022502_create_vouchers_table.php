<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã voucher duy nhất
            $table->enum('discount_type', ['fixed', 'percentage'])->default('fixed'); // Loại giảm giá
            $table->unsignedInteger('min_discount_amount')->nullable(); // Giảm giá tối thiểu (nếu có)
            $table->unsignedInteger('max_discount_amount')->nullable(); // Giảm giá tối đa (nếu có)
            $table->unsignedInteger('min_order_value')->nullable(); // Giá trị đơn hàng tối thiểu để áp dụng
            $table->date('start'); // Ngày bắt đầu
            $table->date('end'); // Ngày kết thúc
            $table->boolean('is_active')->default(1); // Trạng thái hoạt động (1: kích hoạt, 0: vô hiệu)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
};
