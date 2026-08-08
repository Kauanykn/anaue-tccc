<?php

namespace App\Http\Controllers;

use App\Models\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriaController extends Controller
{
    public function index()
    {
        $fotos = Galeria::latest()->get();

        return view('admin.galeria.index', compact('fotos'));
    }


    public function create()
    {
        return view('admin.galeria.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'imagem' => 'required|image|max:5120',
        ]);

        $imagem = $request
            ->file('imagem')
            ->store('galeria', 'public');

        Galeria::create([
            'titulo' => $request->titulo,
            'imagem' => $imagem,
        ]);

        return redirect()
            ->route('admin.galeria.index')
            ->with('success', 'Foto adicionada com sucesso!');
    }


    public function edit(Galeria $galeria)
    {
        return view('admin.galeria.edit', compact('galeria'));
}


    public function update(Request $request, Galeria $galeria)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'imagem' => 'nullable|image|max:5120',
    ]);

    $dados = [
        'titulo' => $request->titulo,
    ];

    if ($request->hasFile('imagem')) {

        Storage::disk('public')->delete($galeria->imagem);

        $dados['imagem'] = $request
            ->file('imagem')
            ->store('galeria', 'public');
    }

    $galeria->update($dados);

    return redirect()
        ->route('admin.galeria.index')
        ->with('success', 'Foto atualizada com sucesso!');
}


    public function destroy(Galeria $galeria)
    {
        Storage::disk('public')->delete($galeria->imagem);

        $galeria->delete();

        return redirect()
            ->route('admin.galeria.index')
            ->with('success', 'Foto excluída com sucesso!');
    }
}