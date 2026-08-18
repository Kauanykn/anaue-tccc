<?php
use App\Http\Controllers\LandingController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\DepoimentoController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/sobre', [LandingController::class, 'sobre'])->name('sobre');

Route::get('/galeria', [LandingController::class, 'galeria'])->name('galeria');

Route::get('/depoimentos', [DepoimentoController::class, 'depoimentos'])->name('depoimentos');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('galeria', GaleriaController::class)
        ->parameters(['galeria' => 'galeria'])
        ->except(['show']);

});