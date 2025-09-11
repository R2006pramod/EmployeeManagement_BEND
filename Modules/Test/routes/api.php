<?php

use Illuminate\Support\Facades\Route;
use Modules\Test\App\Http\Controllers\TestController;

Route::get('test', [TestController::class, 'index']);
