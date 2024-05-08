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
        Schema::create('daily_report_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->date('date');
            $table->foreignId('plan_id');
            $table->boolean('is_closed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_report_logs');
    }
};
