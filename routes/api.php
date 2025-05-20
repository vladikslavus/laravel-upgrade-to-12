<?php

use App\Http\Controllers\Api\BookController as ApiBookController;
use Illuminate\Support\Facades\Route;

Route::get('/books', [ApiBookController::class, 'index']);
Route::post('/books', [ApiBookController::class, 'store']);
Route::get('/books/{id}', [ApiBookController::class, 'show']);
Route::patch('/books/{id}', [ApiBookController::class, 'update']); // Будем использовать метод частичного удаления
Route::delete('/books/{id}', [ApiBookController::class, 'destroy']);
