<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pacote;
use App\Models\Galeria;
use App\Models\Depoimento;

class AdminDashboardController extends Controller
{
        public function index()
    {
        $totalPacotes = Pacote::count();
        $totalFotos = Galeria::count();

        $totalDepoimentos = Depoimento::count();

        $mediaAvaliacoes = $totalDepoimentos > 0
            ? round(Depoimento::avg('nota'), 1)
            : 0;

        return view('admin.dashboard', compact(
            'totalPacotes',
            'totalFotos',
            'totalDepoimentos',
            'mediaAvaliacoes'
        ));
    }
}