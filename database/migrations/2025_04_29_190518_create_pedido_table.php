<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->id('ID_Pedido'); // Primary Key autoincremental
            $table->date('Fecha')->nullable();
            $table->decimal('Total', 10, 2)->nullable();
            $table->enum('Estado', ['pendiente', 'enviado', 'cancelado'])->default('pendiente');
            $table->unsignedBigInteger('ID_Usuario');
            $table->text('Direccion_Envio')->nullable();
            $table->string('Metodo_Pago', 100)->nullable();

            // Foreign Key
            $table->foreign('ID_Usuario')->references('ID_Usuario')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido');
    }
};
