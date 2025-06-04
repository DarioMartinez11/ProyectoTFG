<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class ResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

public function toMail($notifiable)
{
    $url = url("/reset-password/{$this->token}?email=" . urlencode($notifiable->Email));

    return (new MailMessage)
        ->subject('Recuperar contraseña - Pinturas General')
        ->view('emails.password-reset', [
            'user' => $notifiable,
            'url' => $url
        ]);
}

}
