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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            $table->string('payment_method')->nullable(); // usdt, wallet, bank
            $table->string('purpose')->nullable(); // sustainable, relief, orphans, health, other
            $table->string('receipt')->nullable(); // صورة الإيصال
            $table->string('status')->default('pending'); // pending, confirmed, rejected

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
