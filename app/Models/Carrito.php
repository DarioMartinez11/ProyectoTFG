<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito';
    protected $primaryKey = 'ID_Carrito';
     // Desactiva automáticamente los campos created_at y updated_at
    public $timestamps = false;
    protected $fillable = [
        'ID_Usuario'
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCarrito::class, 'ID_Carrito');
    }
}
