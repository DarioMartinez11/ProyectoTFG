<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class ResetPasswordNotification extends Notification
{
    // Token único para restablecimiento de contraseña
    public $token;

    //Constructor que recibe el token de restablecimiento y lo almacena
    public function __construct($token)
    {
        $this->token = $token;
    }

    //Define los canales por los que se enviará la notificación
    public function via($notifiable)
    {
        return ['mail'];
    }

    //Define el contenido del correo que se enviará
public function toMail($notifiable)
{
    // Genera la URL de restablecimiento de contraseña usando el token y el email del usuario
    $url = url("/reset-password/{$this->token}?email=" . urlencode($notifiable->Email));

     // Devuelve un mensaje de correo con asunto y una vista Blade personalizada
    return (new MailMessage)
        ->subject('Recuperar contraseña - Pinturas General')
        ->view('emails.password-reset', [
            'user' => $notifiable,
            'url' => $url
        ]);
}

}
