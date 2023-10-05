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
        Schema::create('customers', function (Blueprint $table) {
            $table->string('customer_code', 20)->primary();
            $table->string('customer_name', 20);
            $table->unsignedInteger('base_id');
            $table->timestamps();
            // 外部キー制約
            $table->foreign('base_id')->references('base_id')->on('bases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
