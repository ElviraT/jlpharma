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
        Schema::table('drugstorex_pharmacies', function (Blueprint $table) {
            $table->unsignedBigInteger('idUser')->default(1);
            $table->foreign('idUser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drugstorex_pharmacies', function (Blueprint $table) {
            //
        });
    }
};
