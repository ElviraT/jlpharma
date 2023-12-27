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
        Schema::create('drugstores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rif');
            $table->string('sada');
            $table->string('sicm');
            $table->string('telefono');
            $table->text('direccion');
            $table->unsignedBigInteger('idstatus')->default(1);
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idZone');

            $table->timestamps();

            $table->foreign('idstatus')->references('id')->on('statuses');
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idZone')->references('id')->on('zones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drugstores');
    }
};
