<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiLivroController;
use App\Http\Controllers\ApiLeitorController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/apiLivro', [ApiLivroController::class, 'index']);
Route::post('/apiLivro', [ApiLivroController::class, 'store']);
Route::get('/apiLivro/{id}', [ApiLivroController::class, 'show']);
Route::put('/apiLivro/{id}', [ApiLivroController::class, 'update']);
Route::delete('/apiLivro/{id}', [ApiLivroController::class, 'destroy']);

Route::get('/apiLeitor', [ApiLeitorController::class, 'index']);
Route::post('/apiLeitor', [ApiLeitorController::class, 'store']);
Route::get('/apiLeitor/{id}', [ApiLeitorController::class, 'show']);
Route::put('/apiLeitor/{id}', [ApiLeitorController::class, 'update']);
Route::delete('/apiLeitor/{id}', [ApiLeitorController::class, 'destroy']);