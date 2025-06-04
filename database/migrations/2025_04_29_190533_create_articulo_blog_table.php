<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articuloblog', function (Blueprint $table) {
            $table->id('ID_Articulo'); // Primary Key autoincremental
            $table->string('Titulo', 255);
            $table->text('Contenido')->nullable();
            $table->date('Fecha')->nullable();
            $table->string('Imagen', 255)->nullable();
            $table->unsignedBigInteger('ID_Usuario');

            // Foreign Key
            $table->foreign('ID_Usuario')->references('ID_Usuario')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articulo_blog');
    }
};
