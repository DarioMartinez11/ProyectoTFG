<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detallecarrito', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Carrito');
            $table->unsignedBigInteger('ID_Producto');
            $table->integer('Cantidad');

            // Primary Key compuesta
            $table->primary(['ID_Carrito', 'ID_Producto']);

            // Foreign Keys
            $table->foreign('ID_Carrito')->references('ID_Carrito')->on('carrito')->onDelete('cascade');
            $table->foreign('ID_Producto')->references('ID_Producto')->on('producto')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_carrito');
    }
};
