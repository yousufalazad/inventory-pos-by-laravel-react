<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], static function(){
Route::post('logout', [AuthController::class, 'logout']);
});