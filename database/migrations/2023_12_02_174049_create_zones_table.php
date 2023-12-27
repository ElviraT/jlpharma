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
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCountry');
            $table->unsignedBigInteger('idState');
            $table->unsignedBigInteger('idCity');
            $table->string('name');
            $table->unsignedBigInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('idCountry')->references('id')->on('countries');
            $table->foreign('idState')->references('id')->on('states');
            $table->foreign('idCity')->references('id')->on('cities');
            $table->foreign('status')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zones');
    }
};
