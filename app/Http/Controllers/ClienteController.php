<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller {
    public function dashboard()
{
    return view('cliente.dashboard');
}

public function atualizarAvatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $nomeArquivo = $request->file('avatar')->store('avatars', 'public');

    $request->user()->update([
        'avatar' => $nomeArquivo,

        ]);
        
        return redirect()->route('cliente.dashboard');
}
}
