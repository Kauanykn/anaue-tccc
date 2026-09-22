<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orcamento;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    public function index()
    {
        $orcamentos = Orcamento::with('user')->latest()->get();

        return view('admin.orcamentos.index', compact('orcamentos'));
    }

    public function atualizarStatus(Request $request, Orcamento $orcamento)
    {
        $dadosValidados = $request->validate([
            'status' => ['required', 'in:aprovado,recusado'],
        ]);

        $orcamento->update($dadosValidados);

        return back()->with(
            'success',
            'Orçamento ' . $dadosValidados['status'] . ' com sucesso.'
        );
    }
}