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
        Schema::create('customer_tag', function (Blueprint $table) {
            $table->increments('customer_tag_id');
            $table->string('customer_code', 20);
            $table->unsignedInteger('tag_id');
            $table->timestamps();
            // 外部キー制約
            $table->foreign('customer_code')->references('customer_code')->on('customers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('tag_id')->references('tag_id')->on('tags')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_tag');
    }
};
