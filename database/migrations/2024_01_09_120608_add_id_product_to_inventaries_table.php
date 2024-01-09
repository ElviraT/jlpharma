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
        Schema::table('inventaries', function (Blueprint $table) {
            $table->unsignedBigInteger('idProduct')->after('id');
            $table->foreign('idProduct')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventaries', function (Blueprint $table) {
            //
        });
    }
};
