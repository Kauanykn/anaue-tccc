<?php

namespace App\Http\Controllers;

use App\Models\Pacote;

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

        return view('pacotes.show', compact('pacote'));
    }
}