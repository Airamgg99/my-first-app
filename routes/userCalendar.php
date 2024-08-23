<?php

use App\Http\Controllers\Calendar\UserCalendarController;

Route::get('/user-calendar', [UserCalendarController::class, 'index'])->name('user.calendar');
Route::post('/user/create-task', [UserCalendarController::class, 'createUserTask']);
Route::put('/user/update-task/{id}', [UserCalendarController::class, 'updateUserTask']);
Route::delete('/user/event/{id}', [UserCalendarController::class, 'deleteUserEvent']);
