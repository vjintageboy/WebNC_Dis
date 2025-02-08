<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Thêm điều kiện kiểm tra bảng tồn tại
        if (!Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
};