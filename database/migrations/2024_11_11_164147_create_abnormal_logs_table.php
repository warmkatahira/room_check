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
        Schema::create('abnormal_logs', function (Blueprint $table) {
            $table->bigIncrements('abnormal_log_id');
            $table->timestamp('access_date');
            $table->string('access_user_name', 20);
            $table->string('abnormal_note', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abnormal_logs');
    }
};
