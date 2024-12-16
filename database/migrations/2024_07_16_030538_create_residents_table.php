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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->boolean("is_alive");
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->string('suffix')->nullable();
            $table->date('birth_date');
            $table->string('place_of_birth');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('phone_number');
            $table->string('citizenship');
            $table->string('nickname');
            $table->string('email')->unique();
            $table->string('current_address');
            $table->string('permanent_address');
            $table->foreignId('barangay_id')->constrained()->onDelete('cascade');
            $table->foreignId('purok_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('mother_id')->nullable();
            $table->unsignedBigInteger('father_id')->nullable();
            $table->foreign('mother_id')->references('id')->on('residents')->onDelete('set null');
            $table->foreign('father_id')->references('id')->on('residents')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
