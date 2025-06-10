<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyecto';
    protected $primaryKey = 'ID_Proyecto';
 // Desactiva automáticamente los campos created_at y updated_at
    public $timestamps = false;
    protected $fillable = [
        'Titulo',
        'Descripcion',
        'Categoria',
        'Fecha',
        'ImagenAntes',
        'ImagenDespues',
        'Ranking',
        'Visible'
    ];

    // Relaciones
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'ID_Proyecto');
    }

    public function favoritos()
    {
        return $this->hasMany(Favoritos::class, 'ID_Proyecto');
    }

    public function ranking()
    {
        return $this->hasOne(RankingProyecto::class, 'ID_Proyecto');
    }
}
