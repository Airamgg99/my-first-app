@extends('layouts.login.login')
@section('title', 'Verify email')
@section('content')

    <div>
        <div class="app font-sans min-w-screen min-h-screen bg-grey-lighter py-8 px-4">
            <h1 class="text-3xl h-48 flex items-center justify-center">Confirmación de correo electrónico</h1>
        </div>

        <div class="content__body py-8 border-b">
            <p>
                Hola {{ $user->name }},
                <br>
                Se ha registrado en nuestra aplicación, pero queda un paso todavía, revise su bandeja de
                entrada
                del correo y confírmelo clicando en el link.
            </p>
        </div>

        <div class="content__footer mt-8 text-center text-grey-darker">
            <h3 class="text-base sm:text-lg mb-4">¡Muchas gracias!</h3>
        </div>

        <div>
            <p>
                Si no le ha llegado ninguna notificación a su correo, por favor, haga
                <a class="text-blue-600 decoration-2 hover:underline font-medium"
                    href="{{ route('verification.send') }}">click aquí</a>
                para reenviar el link de verificación.
            </p>
        </div>

    </div>
