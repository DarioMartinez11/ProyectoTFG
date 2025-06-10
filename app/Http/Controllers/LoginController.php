<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Muestra el formulario de login
    public function show()
    {
        return view('login.login');

    }

    // Procesa el intento de inicio de sesión del usuario
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Mapear credenciales a tus campos personalizados
        if (Auth::attempt([
            'Email' => $request->email,
            'password' => $request->password,
        ])) {
            $user = Auth::user();

            if (!$user->email_verified_at) {
                Auth::logout();
                return back()->withErrors(['email' => 'Tu correo no ha sido verificado.']);
            }

            return redirect()->route('inicio'); 
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
