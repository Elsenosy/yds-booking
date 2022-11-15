<?php

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EmployeeController;
use App\Http\Controllers\Api\V1\RegisterController;
use App\Http\Controllers\Api\V1\ReservationController;
use App\Http\Controllers\Api\V1\StudioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    $controller = AuthController::class;
    $registerController = RegisterController::class;

    Route::post('register', [$registerController, 'register']);
    Route::post('login', [$controller, 'login']);
    Route::get('profile', [$controller, 'profile']);
    Route::post('logout', [$controller, 'logout']);
    Route::post('refresh', [$controller, 'refresh']);
});

// Studios
Route::group(['middleware' => ['api', 'auth:api', 'user_access:'.UserTypeEnum::STUDIO_OWNER], 'prefix' => 'studios'], function () {
    $controller = StudioController::class;
    Route::get('/', [$controller, 'index']);
    Route::post('/', [$controller, 'store']);
});

// Employees
Route::group(['middleware' => ['api', 'auth:api'], 'prefix' => 'employees'], function () {
    $controller = EmployeeController::class;
    Route::get('/', [$controller, 'index']);
    Route::post('/{studio}/change', [$controller, 'changeStudio'])->middleware('user_access:'.UserTypeEnum::EMPLOYEE);
});

// Reservations
Route::group(['middleware' => ['api', 'auth:api'], 'prefix' => 'reservations'], function () {
    $controller = ReservationController::class;
    Route::get('/', [$controller, 'index']);
    Route::post('/new', [$controller, 'reserve'])->middleware('user_access:'.UserTypeEnum::CUSTOMER);
    Route::post('/cancel', [$controller, 'cancel'])->middleware('user_access:'.UserTypeEnum::CUSTOMER);
});
