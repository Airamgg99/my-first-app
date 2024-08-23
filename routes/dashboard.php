<?php

use App\Http\Controllers\Admin\DashboardController;

Route::get('/admin/dashboard/getWorkplaces', [DashboardController::class, 'getWorkplaces']);
Route::get('/admin/dashboard/getContractTypes', [DashboardController::class, 'getContractTypes']);
