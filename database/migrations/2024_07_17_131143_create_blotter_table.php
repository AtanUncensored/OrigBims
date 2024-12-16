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
        Schema::create('blotter', function (Blueprint $table) {
            $table->id();
            $table->string('incident_type');
            $table->string('incident_location');
            $table->string('incident_narative');
            $table->string('status');
            $table->string('schedule');
            $table->date('schedule_date');
            $table->date('date_reported');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blotter');
    }
};
