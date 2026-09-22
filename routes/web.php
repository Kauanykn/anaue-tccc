<?php
        // Existe uma função amaldiçoada chamada MERGE. Ela junta 2 branches,                //A partir de agora, toda vez que alterar  
        // e se vc der merge quando tem alteração de rota sem saber oq foi                  //ou criar uma rota, coloca um comentário
        // alterado, SEMPRE dá merda.                                                      //explicando por favor.
        
        // Então, pelo amor de Deus, NÃO dar merge nas rotas sem saber exatamente
        // oq foi alterado. Não é só clicar em "merge" e torcer pra funcionar.
        // Vai cagar middleware, permissões, nomes de rotas e fazer o site
        // inteiro começar a dar erro.
        
        // OBS:
        // Só dar merge nessa parte se estiver comigo e com Jesus do lado,
        // com uma Bíblia debaixo do braço e rezando o Pai Nosso,
        // pq se der merda aqui, vai ser um saco ajeitar e vou te desviver.
        
        // Menos foco, mais ansiedade.
        // Agradeço a atenção. - Luci


use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DepoimentoController as AdminDepoimentoController;
use App\Http\Controllers\Admin\OrcamentoController as AdminOrcamentoController;
use App\Http\Controllers\Admin\PacoteController as AdminPacoteController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DepoimentoController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\PacoteController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;


// Area admin
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/orcamentos', [
            AdminOrcamentoController::class,
            'index'
        ])->name('orcamentos.index');

        Route::get('/usuarios', [ 
            UsuarioController::class, 
            'index' 
        ])->name('usuarios.index');

        Route::resource('galeria', GaleriaController::class)
            ->parameters(['galeria' => 'galeria'])
            ->except(['show']);

        Route::resource('pacotes', AdminPacoteController::class)
            ->except(['show']);

        Route::resource('depoimentos', AdminDepoimentoController::class)
            ->except(['show']);
    });


// Area publica
Route::get('/', [LandingController::class, 'index'])
    ->name('home');

Route::get('/sobre', [LandingController::class, 'sobre'])
    ->name('sobre');


// Area user
Route::view('/cliente/dashboard', 'cliente.dashboard')
    ->middleware('auth')
    ->name('cliente.dashboard');

Route::post('/cliente/avatar', [
    ClienteController::class,
    'atualizarAvatar'
])
    ->middleware('auth')
    ->name('cliente.avatar');

Route::delete('/cliente/avatar', [
    ClienteController::class,
    'removerAvatar'
])
    ->middleware('auth')
    ->name('cliente.avatar.remover');


// Dashboard admin
Route::get('/admin/dashboard', [
    AdminDashboardController::class,
    'index'
])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');


// Depoimentos
Route::get('/depoimentos', [DepoimentoController::class, 'depoimentos'])
    ->name('depoimentos');

Route::post('/depoimentos', [DepoimentoController::class, 'store'])
    ->name('depoimentos.store');

Route::put('/depoimentos/{depoimento}', [
    DepoimentoController::class,
    'update'
])
    ->middleware(Authenticate::class)
    ->name('depoimentos.update');

Route::delete('/depoimentos/{depoimento}', [
    DepoimentoController::class,
    'destroy'
])
    ->middleware('auth')
    ->name('depoimento.destroy');


// Galeria
Route::get('/galeria', [LandingController::class, 'galeria'])
    ->name('galeria');


// Login/cadastro
Route::get('/login', [LoginController::class, 'show'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.authenticate');

Route::get('/cadastro', [RegisterController::class, 'show'])
    ->name('register');

Route::post('/cadastro', [RegisterController::class, 'register'])
    ->name('register.store');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


// Orcamento
Route::get('/orcamento', [OrcamentoController::class, 'create'])
    ->name('orcamento');

Route::post('/orcamento', [OrcamentoController::class, 'store'])
    ->name('orcamento.store');


// Pacotes
Route::get('/pacotes', [PacoteController::class, 'index'])
    ->name('pacotes');

Route::get('/pacotes/{pacote}', [PacoteController::class, 'show'])
    ->name('pacotes.show');