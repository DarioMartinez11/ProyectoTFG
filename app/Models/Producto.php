<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $primaryKey = 'ID_Producto';
    public $timestamps = false;
    protected $fillable = [
        'Nombre',
        'Descripcion',
        'Precio',
        'Stock',
        'Imagen',
        'Categoria',
        'Destacado'
    ];

    // Relaciones
    public function detalleCarrito()
    {
        return $this->hasMany(DetalleCarrito::class, 'ID_Producto');
    }

    public function detallePedido()
    {
        return $this->hasMany(DetallePedido::class, 'ID_Producto');
    }

    public function imagenes()
{
    return $this->hasMany(Imagen::class, 'producto_id');
}

}
