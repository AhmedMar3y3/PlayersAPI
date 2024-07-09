<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlayersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//public 
Route::post("/login", [AuthController::class,"login"]);
Route::post("/register", [AuthController::class,"register"]);

//protected

Route::group(['middleware' => ['auth:sanctum']], function()
{
    Route::resource('/players', PlayersController::class);
    Route::post('/logout',[AuthController::class , 'logout']);
});
/* Route::group(["middleware"=>['auth:sanctum']], function() {
    Route::post("/player", PlayersController::class);
    Route::post("/logout", [AuthController::class,"logout"]);
    
});*/ 