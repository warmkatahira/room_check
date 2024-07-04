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
        Schema::create('progress_histories', function (Blueprint $table) {
            $table->bigIncrements('progress_id');
            $table->date('date');
            $table->string('customer_code', 20);
            $table->string('item_code', 50);
            $table->integer('progress_value');
            $table->timestamps();
            // 外部キー制約
            $table->foreign('customer_code')->references('customer_code')->on('customers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('item_code')->references('item_code')->on('items')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_histories');
    }
};
