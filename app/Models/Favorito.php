<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorito extends Model
{
    use HasFactory;

    protected $table = 'favoritos_productos';
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = ['ID_Usuario', 'ID_Producto']; // ← esta línea NO funcionará sola

    protected $fillable = [
        'ID_Usuario',
        'ID_Producto'
    ];

    // Esto es esencial: sobrescribe el método getKey() y getKeyName()
    public function getKey()
    {
        return [$this->ID_Usuario, $this->ID_Producto];
    }

    public function getKeyName()
    {
        return ['ID_Usuario', 'ID_Producto'];
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_Producto');
    }
}

