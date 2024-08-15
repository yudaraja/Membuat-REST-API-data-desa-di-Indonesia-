<?php

use App\Http\Controllers\DesaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::prefix('desa')->group(function () {
    Route::get('/', [DesaController::class, 'index']);
    Route::get('/{id}', [DesaController::class, 'show']);
    Route::post('/', [DesaController::class, 'store']);
    Route::put('/{id}', [DesaController::class, 'update']);
    Route::delete('/{id}', [DesaController::class, 'destroy']);
});
