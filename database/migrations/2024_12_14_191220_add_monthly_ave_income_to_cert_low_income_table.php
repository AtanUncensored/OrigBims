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
        Schema::table('cert_low_income', function (Blueprint $table) {
            $table->decimal('monthly_ave_income', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('cert_low_income', function (Blueprint $table) {
            $table->dropColumn('monthly_ave_income');
        });
    }

};
