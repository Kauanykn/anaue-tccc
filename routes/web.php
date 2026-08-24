<?php
use App\Http\Controllers\LandingController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\DepoimentoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClienteController;

use App\Http\Controllers\DepoimentoController;
use App\Http\Controllers\Admin\PacoteController as AdminPacoteController;
use App\Http\Controllers\PacoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PacoteController as AdminPacoteController;
use App\Http\Controllers\PacoteController;



Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/sobre', [LandingController::class, 'sobre'])->name('sobre');

Route::get('/galeria', [LandingController::class, 'galeria'])->name('galeria');

Route::get('/depoimentos', [DepoimentoController::class, 'depoimentos'])->name('depoimentos');
Route::post('/depoimentos', [DepoimentoController::class, 'store'])->name('depoimentos.store');
Route::put('/depoimentos/{depoimento}', [DepoimentoController::class, 'update'])->middleware('auth')->name('depoimentos.update');

Route::get('/login', [LoginController::class, 'show'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.authenticate');

Route::get('/cadastro', [RegisterController::class, 'show'])->name('register');
Route::post('/cadastro', [RegisterController::class, 'register'])->name('register.store');

Route::get('/cliente/dashboard', [ClienteController::class, 'dashboard'])->middleware('auth')->name('cliente.dashboard');
Route::post('/cliente/avatar', [ClienteController::class, 'atualizarAvatar'])->middleware('auth')->name('cliente.avatar');
Route::delete('/cliente/avatar', [ClienteController::class, 'removerAvatar'])->middleware('auth')->name('cliente.avatar.remover');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
Route::resource('galeria', GaleriaController::class)->parameters(['galeria' => 'galeria'])->except(['show']);});


    Route::resource('galeria', GaleriaController::class)
        ->parameters(['galeria' => 'galeria'])
        ->except(['show']);

    Route::resource('pacotes', AdminPacoteController::class)
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

Route::view('/cliente/dashboard', 'cliente.dashboard')
->middleware('auth')
->name('cliente.dashboard');

Route::post('/logout', [LoginController::class, 'logout'])

    ->name('logout');

Route::get('/pacotes', [PacoteController::class, 'index'])
    ->name('pacotes');

Route::get('/pacotes/{pacote}', [PacoteController::class, 'show'])
    ->name('pacotes.show');