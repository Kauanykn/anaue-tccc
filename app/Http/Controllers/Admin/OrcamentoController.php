<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orcamento;


class OrcamentoController extends Controller
{
    public function index()
    {
        $orcamentos = Orcamento::latest()->get();

        return view('admin.orcamentos.index', compact('orcamentos'));
    }
}
