<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // Lista todos os usuarios
    public function index()
{
$usuarioLogado = auth()->user();

$usuarios = User::where('id', '!=', $usuarioLogado->id)
    ->latest()
    ->get();

return view('admin.usuarios.index', compact(
    'usuarioLogado',
    'usuarios'
));

}


    // Atualiza a permissao do usuario
    public function update(Request $request, User $usuario)
{
// Nao pode alterar a propria permissao
if ($usuario->id === auth()->id()) {

    return redirect()
        ->route('admin.usuarios.index')
        ->with('erro', 'Você não pode alterar sua própria permissão.');
}

$request->validate([
    'role' => ['required', 'in:admin,usuario'],
]);

$usuario->role = $request->role;
$usuario->save();

return redirect()
    ->route('admin.usuarios.index')
    ->with('sucesso', 'Permissão atualizada com sucesso.');

}

}