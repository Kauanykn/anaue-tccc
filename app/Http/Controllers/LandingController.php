<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Galeria;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.index');
    }
     public function sobre()
    {
        return view('sobre.index');
    }
     public function galeria()
{
    $fotos = Galeria::latest()->get();

    return view('galeria.index', compact('fotos'));
}
}




