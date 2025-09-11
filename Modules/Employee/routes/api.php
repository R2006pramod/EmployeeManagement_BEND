<?php
use Illuminate\Support\Facades\Route;
use Modules\Employee\App\Http\Controllers\EmployeeController;

Route::post('employees', [EmployeeController::class, 'store']);
