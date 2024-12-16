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
        Schema::create('cert_clearances', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('purok_address');
            $table->string('reason');
            $table->integer('age');
            $table->date('date');
            $table->string('punongbarangay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cert_clearances');
    }
};