<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RankingProyecto extends Model
{
    use HasFactory;

    protected $table = 'ranking_proyecto';
    protected $primaryKey = 'ID_Proyecto';
    protected $fillable = [
        'ID_Proyecto',
        'Total_Comentarios',
        'Media_Valoracion'
    ];

    // Relaciones
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'ID_Proyecto');
    }
}
