<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('stock_imports', function (Blueprint $table) {
        $table->boolean('is_hidden')->default(false)->after('note');
    });
}

public function down()
{
    Schema::table('stock_imports', function (Blueprint $table) {
        $table->dropColumn('is_hidden');
    });
}
};
