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
        Schema::create('alert_settings', function (Blueprint $table) {
            $table->increments('alert_setting_id');
            $table->string('alert_setting_name', 20);
            $table->string('customer_code', 20);
            $table->string('item_code', 50);
            $table->time('alert_time');
            $table->unsignedInteger('alert_value');
            $table->string('alert_message', 20);
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
        Schema::dropIfExists('alert_settings');
    }
};
