<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id('ID_Carrito'); // Primary Key autoincremental
            $table->unsignedBigInteger('ID_Usuario');

            // Foreign Key
            $table->foreign('ID_Usuario')->references('ID_Usuario')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};
