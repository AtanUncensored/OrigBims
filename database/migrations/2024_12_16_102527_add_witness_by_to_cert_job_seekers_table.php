<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cert_job_seekers', function (Blueprint $table) {
            $table->string('witness_by')->nullable()->after('gender'); 
        });
    }
    
    public function down()
    {
        Schema::table('cert_job_seekers', function (Blueprint $table) {
            $table->dropColumn('witness_by');
        });
    }
    
};
