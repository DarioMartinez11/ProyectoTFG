<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto', function (Blueprint $table) {
            $table->id('ID_Proyecto'); // Primary Key autoincremental
            $table->string('Titulo', 255);
            $table->text('Descripcion')->nullable();
            $table->string('Categoria', 50)->nullable();
            $table->date('Fecha')->nullable();
            $table->string('ImagenAntes', 255)->nullable();
            $table->string('ImagenDespues', 255)->nullable();
            $table->decimal('Ranking', 3, 2)->nullable();
            $table->boolean('Visible')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyecto');
    }
};
