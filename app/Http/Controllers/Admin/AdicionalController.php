<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adicional;
use Illuminate\Http\Request;

class AdicionalController extends Controller
{
    public function index()
    {
        $adicionais = Adicional::all();

        return view('admin.adicionais.index', compact('adicionais'));
    }

    public function create()
    {
        return view('admin.adicionais.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
        ]);

        Adicional::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
        ]);

        return redirect()
            ->route('admin.adicionais.index')
            ->with('sucesso', 'Adicional cadastrado com sucesso!');
    }

    public function edit(Adicional $adicional)
    {
        return view('admin.adicionais.edit', compact('adicional'));
    }

    public function update(Request $request, Adicional $adicional)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
        ]);

        $adicional->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
        ]);

        return redirect()
            ->route('admin.adicionais.index')
            ->with('sucesso', 'Adicional atualizado com sucesso!');
    }

    public function destroy(Adicional $adicional)
    {
        $adicional->delete();

        return redirect()
            ->route('admin.adicionais.index')
            ->with('sucesso', 'Adicional excluído com sucesso!');
    }
}