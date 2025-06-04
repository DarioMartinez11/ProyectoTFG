<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PrivacidadController extends Controller
{
    public function index()
    {
        return view('privacidad');
    }

    public function cambiarContrasena(Request $request)
    {
        $request->validate([
            'password_actual' => 'required',
            'nueva_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // IMPORTANTE: el campo correcto en tu base de datos es 'Contraseña', no 'password'
        if (!Hash::check($request->password_actual, $user->Contraseña)) {
            return back()->withErrors(['password_actual' => 'La contraseña actual no es correcta.']);
        }

        // Guardar la nueva contraseña en el campo correcto
        $user->Contraseña = Hash::make($request->nueva_password);
        $user->save();

        return back()->with('success', 'Contraseña cambiada con éxito.');
    }

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
