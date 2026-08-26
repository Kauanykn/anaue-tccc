<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pacote;
use App\Models\Galeria;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPacotes = Pacote::count();
        $totalFotos = Galeria::count();

        return view('admin.dashboard', compact(
            'totalPacotes',
            'totalFotos'
        ));
    }
}