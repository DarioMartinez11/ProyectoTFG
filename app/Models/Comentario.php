<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentario';

    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    // Campos asignables
    protected $fillable = [
        'ID_Usuario',
        'ID_Proyecto',
        'Texto',
        'Fecha',
        'Valoracion',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_Usuario', 'ID_Usuario');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'ID_Proyecto', 'ID_Proyecto');
    }
}
