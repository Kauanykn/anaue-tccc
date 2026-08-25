<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depoimento;
use Illuminate\Support\Facades\Auth;


class DepoimentoController extends Controller
{
    public function depoimentos()
{
    $depoimentos = Depoimento::with('usuario')
        ->latest()
        ->get();

    $totalAvaliacoes = $depoimentos->count();

    $mediaAvaliacoes = $totalAvaliacoes > 0
        ? round($depoimentos->avg('nota'), 1)
        : 0;

    $quantidadeNotas = [];

    for ($nota = 5; $nota >= 1; $nota--) {
        $quantidadeNotas[$nota] = $depoimentos
            ->where('nota', $nota)
            ->count();
    }

    $meuDepoimento = Auth::check()
        ? $depoimentos->firstWhere('usuario_id', Auth::id())
        : null;

    return view('depoimentos.index', compact(
        'depoimentos',
        'meuDepoimento',
        'totalAvaliacoes',
        'mediaAvaliacoes',
        'quantidadeNotas'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'nota' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string',
        ]);

        Depoimento::create([
            'usuario_id' => Auth::id(),
            'nota' => $request->nota,
            'comentario' => $request->comentario,
        ]);

        return redirect()->route('depoimentos');

    }

    public function update(Request $request, Depoimento $depoimento)
{
    // Garante que o usuário só possa editar a própria avaliação
    if ($depoimento->usuario_id !== Auth::id()) {
        abort(403);
    }

    $request->validate([
        'nota' => 'required|integer|min:1|max:5',
        'comentario' => 'required|string',
    ]);

    $depoimento->update([
        'nota' => $request->nota,
        'comentario' => $request->comentario,
    ]);

    return redirect()->route('depoimentos');
}

public function destroy(Depoimento $depoimento)
{
    if ($depoimento->usuario_id !== Auth::id()) {
        abort(403);
    }

    $depoimento->delete();

    return redirect()->route('depoimentos');
}
}
