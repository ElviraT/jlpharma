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
            $table->float('price_cs', 10, 2);
            $table->float('price_dg', 10, 2);
            $table->float('price_tf', 10, 2)->nullable();
            $table->integer('quantity');
            $table->integer('quantity_min');
            $table->integer('quantity_tf')->nullable();
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