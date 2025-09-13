<?php

use Illuminate\Support\Facades\Route;
use Modules\Employee\App\Http\Controllers\EmployeeController;

//View All Employees
Route::get('/employees', [EmployeeController::class, 'index']);

//Add New Employee
Route::post('/employees', [EmployeeController::class, 'store']);

//Update An Employee
Route::put('/employees/{employee}', [EmployeeController::class, 'update']);

//Delete An Employee
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);

//Search For Employees
Route::get('/employees/search', [EmployeeController::class, 'search']);
