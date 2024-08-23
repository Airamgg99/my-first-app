<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

//* RUTAS PÚBLICAS
Route::middleware('public')->group(function () {
    //* Rutas para autenticación
    include('auth.php');

    //* Rutas para contraseña
    include('password.php');
});


//* RUTAS PROTEGIDAS ESTANDO LOGUEADO
Route::middleware('auth')->group(function () {

    // Redirige a la pantalla de login
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //* RUTAS SI ESTÁS ACTIVO
    Route::middleware('active')->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('index');

        //* Rutas del calendario para usuarios
        include('userCalendar.php');

        //* RUTAS DEL ADMINISTRADOR
        Route::middleware('admin')->group(
            function () {
                //* Rutas para manejo de usuarios
                include('admin.php');

                //* Ruta para manejo de centros de trabajo
                include('workplace.php');

                //* Ruta para manejo de trabajos
                include('job.php');

                //* Ruta para manejo de contratos de trabajo
                include('contract_type.php');

                //* Rutas del calendario para administradores
                include('adminCalendar.php');

                //* Muestra la tabla con la información de usuarios y centros de trabajo
                include('dashboard.php');
            }
        );
    });
});
