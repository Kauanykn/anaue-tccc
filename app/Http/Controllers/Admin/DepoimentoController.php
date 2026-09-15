<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depoimento;
use Illuminate\Support\Facades\Storage;

class DepoimentoController extends Controller
{
    public function index()
    {
        $depoimentos = Depoimento::with('usuario')
            ->latest()
            ->get();

        return view('admin.depoimento.index', compact('depoimentos'));
    }

    public function destroy(Depoimento $depoimento)
    {
        $depoimento->delete();

        return redirect()
            ->route('admin.depoimentos.index')
            ->with('success', 'Depoimento excluído com sucesso!');
    }
}