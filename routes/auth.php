<?php

use App\Http\Controllers\Auth\AuthController;

//* Rutas para registrarse en la app
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerTry'])->name('register.try');

//* Rutas para iniciar sesión en la app
Route::get('/login', [AuthController::class, 'index'])->name('login.index');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

//* Ruta que mandará el email para confirmarlo
Route::get('/email/verify', [AuthController::class, 'verifyMail'])->name('verification.notice');

//* Ruta que verificará el email cuando el usuario lo confirme en su correo
Route::get('/email/verify/{hash}', [AuthController::class, 'verified'])->name('verification.verify');

//* Ruta que permitirá reenviar el link de verificación
Route::post('/email/verification-notification', [AuthController::class,])->name('verification.send');
