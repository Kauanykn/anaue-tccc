<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depoimento;

class DepoimentoController extends Controller
{
    public function depoimentos()
    {
        $depoimentos = Depoimento::all();

        return view('depoimentos.index', compact('depoimentos'));
    }
}
