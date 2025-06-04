<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'ID_Usuario';

    protected $fillable = [
        'Nombre',
        'Email',
        'Contraseña',
        'Rol',
        'Fecha_Registro',
        'email_verification_token',
        'email_verified_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->Contraseña;
    }

    public function getEmailForPasswordReset()
    {
        return $this->Email;
    }

    /**
     * Notificación personalizada para recuperación de contraseña.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function setPasswordAttribute($value)
{
    $this->attributes['Contraseña'] = $value;
}


    // Relaciones
    public function carrito()
    {
        return $this->hasOne(Carrito::class, 'ID_Usuario');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'ID_Usuario');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'ID_Usuario');
    }

    public function articulos()
    {
        return $this->hasMany(ArticuloBlog::class, 'ID_Usuario');
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class, 'ID_Usuario');
    }
}
