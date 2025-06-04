<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detallepedido', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Pedido');
            $table->unsignedBigInteger('ID_Producto');
            $table->integer('Cantidad');
            $table->decimal('Precio_Unitario', 10, 2);

            // Primary Key compuesta
            $table->primary(['ID_Pedido', 'ID_Producto']);

            // Foreign Keys
            $table->foreign('ID_Pedido')->references('ID_Pedido')->on('pedido')->onDelete('cascade');
            $table->foreign('ID_Producto')->references('ID_Producto')->on('producto')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_pedido');
    }
};
