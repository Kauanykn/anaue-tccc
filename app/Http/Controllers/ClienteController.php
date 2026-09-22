<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Orcamento;

class ClienteController extends Controller 
{
        
    public function dashboard()
{
    $orcamento = \App\Models\Orcamento::where('user_id', auth()->id())
        ->latest()
        ->first();

    return view('cliente.dashboard', compact('orcamento'));
}

    /**
     * Exibe todos os pedidos de orçamento do cliente autenticado.
     */
    public function orcamentos()
    {
        $orcamentos = Orcamento::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('cliente.orcamentos', compact('orcamentos'));
    }

    public function atualizarAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $nomeArquivo = $request->file('avatar')->store('avatars', 'public');

        $request->user()->update([
            'avatar' => $nomeArquivo,

        ]);
            
            return redirect()->route('cliente.dashboard');
    }

    public function removerAvatar(Request $request)
    {
        $usuario = $request->user();
        
        if ($usuario->avatar) {
            Storage::disk('public')->delete($usuario->avatar);
        }
        
        $usuario->update([
            'avatar' => null,
        ]);
            
            return redirect()->route('cliente.dashboard');
    }

 }
