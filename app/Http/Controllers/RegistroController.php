<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistroController extends Controller
{
    // Muestra la vista del formulario de registro
    public function show()
    {
        return view('login.registro');
    }

    // Procesa el registro de un nuevo usuario
    public function register(Request $request)
    {
      
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:users,Email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo debe tener un formato válido (como pintura@correo.com).',
            'email.unique' => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Generar un token único para la verificación del correo
        $token = Str::uuid();

        // Crear el usuario con el token de verificación
        $user = User::create([
            'Nombre' => $request->nombre,
            'Email' => $request->email,
            'Contraseña' => Hash::make($request->password),
            'Rol' => 'user',
            'Fecha_Registro' => now(),
            'email_verification_token' => $token,
        ]);

        // Crea la URL de verificación de correo
        $verificationUrl = route('verificar.email', ['token' => $token]);

        // Enviar correo de verificación
        Mail::raw("Hola {$user->Nombre},\n\nGracias por registrarte en Pinturas General. Verifica tu correo haciendo clic en este enlace:\n\n$verificationUrl", function ($message) use ($user) {
            $message->to($user->Email)
                    ->subject('Verifica tu correo | Pinturas General');
        });

        // Redirige al login con un mensaje
        return redirect()->route('login')->with('status', 'Registro exitoso. Verifica tu correo antes de iniciar sesión.');
    }


    // Verifica el correo electrónico cuando el usuario hace clic en el enlace
    public function verificarEmail($token)
    {
        $user = User::where('email_verification_token', $token)->firstOrFail();

        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->save();

        return redirect()->route('login')->with('status', 'Correo verificado correctamente. Ya puedes iniciar sesión.');
    }
}
