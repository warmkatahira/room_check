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
        Schema::create('access_logs', function (Blueprint $table) {
            $table->bigIncrements('access_log_id');
            $table->timestamp('access_date');
            $table->string('access_user_name', 20)->nullable();
            $table->string('access_user_id', 20)->nullable();
            $table->string('access_user_code', 20)->nullable();
            $table->string('access_door_name', 20);
            $table->string('access_door_id', 20);
            $table->string('access_action', 20);
            $table->string('access_device_type', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_logs');
    }
};
