<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depoimento;
use Illuminate\Support\Facades\Auth;


class DepoimentoController extends Controller
{
    public function depoimentos()
    {
        $depoimentos = Depoimento::all();

        $meuDepoimento = Depoimento::where('usuario_id', Auth::id())->first();

        return view('depoimentos.index', compact('depoimentos', 'meuDepoimento'));

        
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
}
