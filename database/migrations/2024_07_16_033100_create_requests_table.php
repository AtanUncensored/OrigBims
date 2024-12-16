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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('certificate_type_id')->constrained()->onDelete('cascade');
            $table->string('reference_number')->nullable();
            $table->string('requester_name');
            $table->string('purpose');
            $table->string('business_name')->nullable();
            $table->string('monthly_ave_income')->nullable();
            $table->string('witness_by')->nullable();
            $table->string('or_number')->nullable();
            $table->date('date_needed');
            $table->timestamp('downloaded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
