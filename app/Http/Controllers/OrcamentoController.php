<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Models\Pacote;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    public function create()
    {
        $datasIndisponiveis = Orcamento::whereNotNull('data_evento')
            ->get(['data_evento'])
            ->pluck('data_evento')
            ->map(fn ($data) => $data->format('Y-m-d'))
            ->values();

        $pacotes = Pacote::where('ativo', true)
            ->orderBy('nome')
            ->get(['id', 'nome']);

        return view('orcamento.index', compact('datasIndisponiveis', 'pacotes'));
    }

    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'aniversariante' => 'nullable|string|max:255',
            'idade' => 'nullable|string|max:50',
            'data_evento' => 'required|date',
            'quantidade_convidados' => 'nullable|integer|min:1',
            'pacote' => 'nullable|string|max:255',
            'observacoes' => 'nullable|string',
        ], [
            'nome.required' => 'Digite seu nome.',
            'telefone.required' => 'Digite seu telefone ou WhatsApp.',
            'email.email' => 'Digite um e-mail válido.',
            'data_evento.required' => 'Escolha uma data para o evento.',
            'quantidade_convidados.integer' => 'A quantidade de convidados deve ser um número.',
            'quantidade_convidados.min' => 'A quantidade de convidados deve ser pelo menos 1.',
        ]);

        if (Orcamento::whereDate('data_evento', $dadosValidados['data_evento'])->exists()) {
            return back()
                ->withInput()
                ->withErrors(['data_evento' => 'Esta data já possui uma solicitação. Escolha outra data.']);
        }

        Orcamento::create($dadosValidados);

        return redirect()
            ->route('orcamento')
            ->with('success', 'Pedido enviado com sucesso! Em breve entraremos em contato.');
    }
}
