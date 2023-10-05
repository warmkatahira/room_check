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
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('role_id');
            $table->string('role_name', 20);
            $table->boolean('role_operation_is_available')->default(0);
            $table->boolean('user_operation_is_available')->default(0);
            $table->boolean('base_operation_is_available')->default(0);
            $table->boolean('customer_operation_is_available')->default(0);
            $table->boolean('item_operation_is_available')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
