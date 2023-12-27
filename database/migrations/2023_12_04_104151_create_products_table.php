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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('codigo');
            $table->string('img')->nullable();
            $table->double('price_cs');
            $table->double('price_dg');
            $table->double('price_tf');
            $table->integer('quantity');
            $table->integer('quantity_min');
            $table->integer('quantity_tf');
            $table->unsignedBigInteger('idCategory');
            $table->boolean('available')->default(1);
            $table->timestamps();

            $table->foreign('idCategory')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
