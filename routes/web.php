<?php
use App\Http\Controllers\LandingController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;



Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/sobre', [LandingController::class, 'sobre'])->name('sobre');

Route::get('/galeria', [LandingController::class, 'galeria'])->name('galeria');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('galeria', GaleriaController::class)
        ->parameters(['galeria' => 'galeria'])
        ->except(['show']);

});

Route::get('/login', [LoginController::class, 'show'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.authenticate');

Route::get('/cadastro', [RegisterController::class, 'show'])
->name('register');

Route::post('/cadastro', [RegisterController::class, 'register'])
    ->name('register.store');