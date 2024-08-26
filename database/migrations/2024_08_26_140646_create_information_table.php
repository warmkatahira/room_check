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
        Schema::create('information', function (Blueprint $table) {
            $table->increments('information_id');
            $table->string('customer_code', 20);
            $table->string('label', 20);
            $table->string('value', 10);
            $table->string('unit', 10);
            $table->timestamps();
            // 外部キー制約
            $table->foreign('customer_code')->references('customer_code')->on('customers')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
