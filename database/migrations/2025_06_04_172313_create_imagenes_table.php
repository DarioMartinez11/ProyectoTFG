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
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('producto_id');
            $table->string('ruta', 100)->nullable();
            $table->timestamps();

            $table->primary('id');
            
            // Foreign Key
            $table->foreign('producto_id')->references('ID_Producto')->on('producto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes');
    }
};
