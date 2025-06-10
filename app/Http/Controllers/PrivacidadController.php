<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PrivacidadController extends Controller
{
    // Muestra la vista de configuración de privacidad del usuario (perfil, cambio de contraseña, etc.)
    public function index()
    {
        return view('privacidad');
    }

    // Muestra el formulario para cambiar la contraseña
    public function cambiarContrasena(Request $request)
    {
         // Valida que se ingrese la contraseña actual y la nueva (confirmada y con mínimo 6 caracteres)
        $request->validate([
            'password_actual' => 'required',
            'nueva_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

         // Verifica que la contraseña actual sea correcta
        if (!Hash::check($request->password_actual, $user->Contraseña)) {
            return back()->withErrors(['password_actual' => 'La contraseña actual no es correcta.']);
        }

        // Guardar la nueva contraseña en el campo correcto
        $user->Contraseña = Hash::make($request->nueva_password);
        $user->save();

        return back()->with('success', 'Contraseña cambiada con éxito.');
    }

    // Actualiza el correo electrónico del usuario
    public function actualizarCorreo(Request $request)
    {
        $request->validate([
            'nuevo_correo' => 'required|email|unique:users,email',
        ]);

        $user = Auth::user();
        $user->email = $request->nuevo_correo;
        $user->save();

        return back()->with('success', 'Correo actualizado con éxito.');
    }
}
