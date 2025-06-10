<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleCarrito extends Model
{
    use HasFactory;

    protected $table = 'DetalleCarrito';
    protected $primaryKey = null; 
     // Desactiva automáticamente los campos created_at y updated_at
     public $timestamps = false;
    public $incrementing = false; 
    protected $fillable = [
        'ID_Carrito',
        'ID_Producto',
        'Cantidad'
    ];

    // Relaciones
    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'ID_Carrito');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_Producto');
    }
}
