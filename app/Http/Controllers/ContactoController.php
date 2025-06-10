<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    // Mostrar la vista del formulario
    public function index()
    {
        return view('contacto');
    }

    // Procesar el formulario y enviar el correo
    public function enviar(Request $request)
    {
        // Validación actualizada
        $request->validate([
            'nombre'               => 'required|string|max:100',
            'email'                => 'required|email',
            'telefono'             => 'nullable|string|max:20',
            'mensaje'              => 'required|string|max:1000',
            'servicio'             => 'nullable|string|max:100',
            'motivo'               => 'nullable|array',
            'preferencia_contacto' => 'nullable|string',
        ]);
    
        // Convertir array de motivos a texto
        $motivosTexto = $request->motivo ? implode(', ', $request->motivo) : 'No especificado';
    
        // Enviar correo - Metodo para enviar el correo
        Mail::raw(
            "Nuevo mensaje de contacto:\n\n" .
            "Nombre: {$request->nombre}\n" .
            "Email: {$request->email}\n" .
            "Teléfono: {$request->telefono}\n\n" .
            "Servicio de interés: {$request->servicio}\n" .
            "Motivo(s) de contacto: {$motivosTexto}\n" .
            "Preferencia de contacto: {$request->preferencia_contacto}\n\n" .
            "Mensaje:\n{$request->mensaje}",
            function ($message) {
                $message->to('dariomartinezvila11@gmail.com')
                        ->subject('Mensaje desde la web de Pinturas General');
            }
        );
    
        return back()->with('success', 'Tu mensaje ha sido enviado correctamente.');
    }
    
}
