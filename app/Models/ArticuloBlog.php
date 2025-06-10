<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticuloBlog extends Model
{
    protected $table = 'articuloblog';

    protected $primaryKey = 'ID_Articulo';
 // Desactiva automáticamente los campos created_at y updated_at
    public $timestamps = false; 

    protected $fillable = [
        'Titulo',
        'Contenido',
        'Fecha',
        'Imagen',
        'ID_Usuario'
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }
}
