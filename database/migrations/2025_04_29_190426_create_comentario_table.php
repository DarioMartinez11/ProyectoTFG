<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comentario', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Usuario');
            $table->unsignedBigInteger('ID_Proyecto');
            $table->text('Texto')->nullable();
            $table->date('Fecha')->nullable();
            $table->integer('Valoracion');

            // Primary Key compuesta
            $table->primary(['ID_Usuario', 'ID_Proyecto']);

            // Foreign Keys
            $table->foreign('ID_Usuario')->references('ID_Usuario')->on('users')->onDelete('cascade');
            $table->foreign('ID_Proyecto')->references('ID_Proyecto')->on('proyecto')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comentario');
    }
};
