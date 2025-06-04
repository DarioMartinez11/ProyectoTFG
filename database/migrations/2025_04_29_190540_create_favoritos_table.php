<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favoritos_productos', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Usuario');
            $table->unsignedBigInteger('ID_Producto');

            // Primary Key compuesta
            $table->primary(['ID_Usuario', 'ID_Producto']);

            // Foreign Keys
            $table->foreign('ID_Usuario')->references('ID_Usuario')->on('users')->onDelete('cascade');
            $table->foreign('ID_Producto')->references('ID_Producto')->on('producto')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};
