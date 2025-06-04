<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id('ID_Producto'); 
            $table->string('Nombre', 100);
            $table->text('Descripcion')->nullable();
            $table->decimal('Precio', 10, 2);
            $table->integer('Stock')->default(0);
            $table->string('Imagen', 255)->nullable();
            $table->string('Categoria', 50)->nullable();
            $table->boolean('Destacado')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
