<?php

use App\Http\Controllers\Password\PasswordController;

//* Ruta que devolverá la vista con el link de reseteo
Route::get('/forgot-password', [PasswordController::class, 'show'])->name('password.request');

//* Ruta que validará el email y mandará el correo con el reseteo de contraseña al usuario
Route::post('/forgot-password', [PasswordController::class, 'reset'])->name('password.email');

//* Ruta que redirigirá al formulario tras hacer click en el link enviado por correo
Route::get('/reset-password/{token}', [PasswordController::class, 'send'])->name('password.link');

//* Rutas para resetear la contraseña
Route::post('/reset-password/{user_id}', [PasswordController::class, 'update'])->name('password.update');
