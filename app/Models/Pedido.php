<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido';
    protected $primaryKey = 'ID_Pedido';
    public $timestamps = false;
    protected $fillable = [
        'Fecha',
        'Total',
        'Estado',
        'ID_Usuario',
        'Direccion_Envio',
        'Metodo_Pago'
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }

    public function detallePedido()
    {
        return $this->hasMany(DetallePedido::class, 'ID_Pedido');
    }
}
