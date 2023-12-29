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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idSend');
            $table->unsignedBigInteger('idReceives');
            $table->unsignedBigInteger('idUser');
            $table->float('total', 10, 2);
            $table->timestamps();

            $table->foreign('idSend')->references('id')->on('users');
            $table->foreign('idReceives')->references('id')->on('users');
            $table->foreign('idUser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
