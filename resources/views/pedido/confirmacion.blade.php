@extends('layouts.app')

@section('title', 'Confirmación de pedido')

@section('content')
    <div style="min-height: calc(100vh - 120px); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 40px 20px;">
        <h1 style="font-size: 1.8rem; margin-bottom: 10px;">🎉 ¡Gracias por tu compra!</h1>
        <p>Te hemos enviado un correo con los detalles de tu pedido.</p>

        @if(session('success'))
            <div style="
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
                padding: 15px;
                border-radius: 5px;
                margin: 20px auto;
                max-width: 600px;
                font-weight: bold;">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('tienda.index') }}"
           style="margin-top: 20px; display: inline-block; background: #28a745; color: white; padding: 12px 20px; border-radius: 6px; text-decoration: none;">
            Volver a la tienda
        </a>
    </div>

    <style>
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #1a1a1a;
            color: white;
            text-align: center;
            padding: 16px;
            font-size: 14px;
            z-index: 1000;
        }
    </style>
@endsection
