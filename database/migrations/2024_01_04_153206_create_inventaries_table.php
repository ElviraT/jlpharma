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
        Schema::create('inventaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('idUser');
            $table->float('price', 10, 2)->nullable();
            $table->integer('quantity');
            $table->integer('quantity_min')->nullable();
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaries');
    }
};
