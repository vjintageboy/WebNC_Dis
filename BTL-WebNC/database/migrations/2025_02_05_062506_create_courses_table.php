<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Chạy migration.
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            // Định nghĩa khóa ngoại cho cột instructor_id, cho phép null nếu cần
            $table->foreignId('instructor_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }
    
    /**
     * Hoàn tác migration.
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
