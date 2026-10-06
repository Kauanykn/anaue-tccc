<?php

namespace App\Http\Controllers;

use App\Models\Pacote;
use App\Models\Adicional;

class PacoteController extends Controller
{
    public function index()
    {
        $pacotes = Pacote::where('ativo', true)
            ->latest()
            ->get();

        return view('pacotes.index', compact('pacotes'));
    }

    public function show(Pacote $pacote)
    {
        if (!$pacote->ativo) {
            abort(404);
        }

        $adicionais = Adicional::orderBy('nome')->get();

        return view('pacotes.show', compact('pacote', 'adicionais'));
    }
}
