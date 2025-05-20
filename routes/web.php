<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
// Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('/books', [BookController::class, 'show']);
Route::get('/books/insert/{id}', [BookController::class, 'insertBookByAuthorId']);


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth'); // Автоматическая проверка авторизации
// Вешаем проверку авторизации на все роуты, чтобы не вешать по отдельности
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logOut'])->name('logout');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::patch('/profile', [AuthController::class, 'updateProfile'])->name('updateProfile');

    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('changePasswordForm');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');
});

Route::get('/latest-grade', [TestController::class, 'latestGradeRelation']);
Route::get('/first-grade', [TestController::class, 'firstGradeRelation']);
Route::get('/highest-grade', [TestController::class, 'highestGradeRelation']);
Route::get('/lowest-grade', [TestController::class, 'lowestGradeRelation']);
Route::get('/latest-valid-grade', [TestController::class, 'latestValidGradeRelation']);

Route::get('/show-monitor-by-teacher', [TestController::class, 'showMonitorByTeacher']);
