<?php

use App\Http\Controllers\Calendar\AdminCalendarController;

Route::get('/admin-calendar', [AdminCalendarController::class, 'index'])->name('admin.calendar');
Route::post('/admin/create-task', [AdminCalendarController::class, 'createAdminTask']);
Route::put('/admin/update-task/{id}', [AdminCalendarController::class, 'updateAdminTask']);
Route::delete('/admin/event/{id}', [AdminCalendarController::class, 'deleteAdminEvent']);
Route::get('/admin/get-workplaces/{user}', [AdminCalendarController::class, 'getWorkplaces']);
Route::get('/admin/workplaces/{userId?}', [AdminCalendarController::class, 'getWorkplacesByUser']);
