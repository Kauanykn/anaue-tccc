<?php
use App\Http\Controllers\LandingController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\DepoimentoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Admin\PacoteController as AdminPacoteController;
use App\Http\Controllers\PacoteController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

Route::prefix('admin')->name('admin.')->group(function () {
Route::resource('galeria', GaleriaController::class)->parameters(['galeria' => 'galeria'])->except(['show']);
Route::resource('pacotes', AdminPacoteController::class)->except(['show']);});

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/sobre', [LandingController::class, 'sobre'])->name('sobre');

Route::get('/galeria', [LandingController::class, 'galeria'])->name('galeria');

Route::get('/depoimentos', [DepoimentoController::class, 'depoimentos'])->name('depoimentos');
Route::post('/depoimentos', [DepoimentoController::class, 'store'])->name('depoimentos.store');
Route::put('/depoimentos/{depoimento}', [DepoimentoController::class, 'update'])->middleware(Authenticate::class)->name('depoimentos.update');
Route::delete('/depoimentos/{depoimento}', [DepoimentoController::class, 'destroy'])->middleware('auth')->name('depoimentos.destroy');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function  () {
Route::resource('galeria', GaleriaController::class)->parameters(['galeria' => 'galeria'])->except(['show']);
Route::resource('pacotes', AdminPacoteController::class)->except(['show']);});

Route::get('/login', [LoginController::class, 'show'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.authenticate');

Route::get('/cadastro', [RegisterController::class, 'show'])->name('register');

Route::post('/cadastro', [RegisterController::class, 'register'])->name('register.store');

Route::view('/cliente/dashboard', 'cliente.dashboard')->middleware('auth')->name('cliente.dashboard');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/pacotes', [PacoteController::class, 'index'])->name('pacotes');

Route::get('/pacotes/{pacote}', [PacoteController::class, 'show'])->name('pacotes.show');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'role:admin'])->name('admin.dashboard');

 Route::get('/orcamento', function () {
 return view('orcamento.index');
 })->name('orcamento');
