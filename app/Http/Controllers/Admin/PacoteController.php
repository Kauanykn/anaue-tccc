<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pacote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PacoteController extends Controller
{
    public function index()
    {
        $pacotes = Pacote::latest()->get();

        return view('admin.pacotes.index', compact('pacotes'));
    }


    public function create()
    {
        return view('admin.pacotes.create');
    }


    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'duracao' => ['required', 'integer', 'min:1'],

            'imagem' => [
                'required',
                'mimes:jpg,jpeg,png,webp',
                'max:10240'
            ],

            'cardapio' => ['required', 'string'],

            'preco_semana_30' => ['required', 'numeric', 'min:0'],
            'preco_semana_50' => ['required', 'numeric', 'min:0'],

            'preco_fim_semana_30' => ['required', 'numeric', 'min:0'],
            'preco_fim_semana_50' => ['required', 'numeric', 'min:0'],

            'valor_excedente' => ['required', 'numeric', 'min:0'],

            'parcelas' => ['required', 'integer', 'min:1'],
        ]);

        $dados['imagem'] = $request
            ->file('imagem')
            ->store('pacotes', 'public');

        $dados['decoracao_inclusa'] =
            $request->boolean('decoracao_inclusa');

        $dados['ativo'] =
            $request->boolean('ativo');

        Pacote::create($dados);

        return redirect()
            ->route('admin.pacotes.index')
            ->with('success', 'Pacote cadastrado com sucesso!');
    }


    public function edit(Pacote $pacote)
    {
        return view('admin.pacotes.edit', compact('pacote'));
    }


    public function update(Request $request, Pacote $pacote)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'duracao' => ['required', 'integer', 'min:1'],

            'imagem' => [
                'nullable',
                'mimes:jpg,jpeg,png,webp',
                'max:10240'
            ],

            'cardapio' => ['required', 'string'],

            'preco_semana_30' => ['required', 'numeric', 'min:0'],
            'preco_semana_50' => ['required', 'numeric', 'min:0'],

            'preco_fim_semana_30' => ['required', 'numeric', 'min:0'],
            'preco_fim_semana_50' => ['required', 'numeric', 'min:0'],

            'valor_excedente' => ['required', 'numeric', 'min:0'],

            'parcelas' => ['required', 'integer', 'min:1'],
        ]);

        if ($request->hasFile('imagem')) {

            Storage::disk('public')->delete($pacote->imagem);

            $dados['imagem'] = $request
                ->file('imagem')
                ->store('pacotes', 'public');
        }

        $dados['decoracao_inclusa'] =
            $request->boolean('decoracao_inclusa');

        $dados['ativo'] =
            $request->boolean('ativo');

        $pacote->update($dados);

        return redirect()
            ->route('admin.pacotes.index')
            ->with('success', 'Pacote atualizado com sucesso!');
    }


    public function destroy(Pacote $pacote)
    {
        Storage::disk('public')->delete($pacote->imagem);

        $pacote->delete();

        return redirect()
            ->route('admin.pacotes.index')
            ->with('success', 'Pacote excluído com sucesso!');
    }
}