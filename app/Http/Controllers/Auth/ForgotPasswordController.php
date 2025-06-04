<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

   public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $user = \App\Models\User::where('Email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'No se encontró un usuario con ese correo.']);
    }

    $token = \Str::random(64);

    \DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $user->Email],
        [
            'token' => bcrypt($token),
            'created_at' => now()
        ]
    );

    \Mail::send('emails.password-reset', ['user' => $user, 'url' => url("/reset-password/{$token}?email=" . urlencode($user->Email))], function ($message) use ($user) {
        $message->to($user->Email)
                ->subject('Recuperar contraseña - Pinturas General');
    });

    return back()->with('status', 'Se ha enviado el enlace de recuperación a tu correo.');
}

}
