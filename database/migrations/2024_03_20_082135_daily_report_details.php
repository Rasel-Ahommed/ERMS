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
        Schema::create('daily_report_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('daily_log_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('date');
            $table->string('work_title')->nullable();
            $table->text('work_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_report_details');
    }
};
