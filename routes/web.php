<?php
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/sobre', [LandingController::class, 'sobre'])->name('sobre');
