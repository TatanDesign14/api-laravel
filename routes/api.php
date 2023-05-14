<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\CountriesController;
use App\Http\Controllers\Api\DepartamentsController;
use App\Http\Controllers\Api\SchoolsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UsersController::class);
Route::apiResource('countries', CountriesController::class);
Route::apiResource('departaments', DepartamentsController::class);
Route::apiResource('schools', SchoolsController::class);
Route::get('solution1/{id}', [DepartamentsController::class,'solution1']);
Route::get('solution2/{id}', [DepartamentsController::class,'solution2']);
Route::get('solution3/{id}', [SchoolsController::class,'solution3']);
Route::get('solution4/{id}', [UsersController::class,'solution4']);
Route::get('solution5/{id}', [UsersController::class,'solution5']);
Route::get('solution6', [UsersController::class,'solution6']);
Route::get('solution7', [UsersController::class,'solution7']);
Route::get('solution8', [SchoolsController::class,'solution8']);
