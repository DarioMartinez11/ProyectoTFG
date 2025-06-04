<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ranking_proyecto', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Proyecto')->primary(); // Primary Key
            $table->integer('Total_Comentarios')->default(0);
            $table->decimal('Media_Valoracion', 3, 2)->default(0);

            // Foreign Key
            $table->foreign('ID_Proyecto')->references('ID_Proyecto')->on('proyecto')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ranking_proyecto');
    }
};
