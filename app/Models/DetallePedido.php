<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detallepedido';
    protected $primaryKey = null; 
    public $incrementing = false; 
     // Desactiva automáticamente los campos created_at y updated_at
    public $timestamps = false;
    protected $fillable = [
        'ID_Pedido',
        'ID_Producto',
        'Cantidad',
        'Precio_Unitario'
    ];

    // Relaciones
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'ID_Pedido');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_Producto');
    }
}
