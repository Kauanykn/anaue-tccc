<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsuarioController extends Controller
{
    // Lista todos os usuarios
    public function index()
    {
        $usuarios = User::latest()->get();

        return view('admin.usuarios.index', compact('usuarios'));
    }
}
